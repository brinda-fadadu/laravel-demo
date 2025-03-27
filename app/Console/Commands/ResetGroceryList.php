<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Grocery;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use App\Mail\GroceryDeletionNotification;
use Illuminate\Support\Facades\Mail;
use App\Api\Controllers\DashboardController;
use App\Models\ScheduleRecipe;
use App\Helpers\Helper;

class ResetGroceryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grocery:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Grocery List Every Week on Sunday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $deleteDay = Carbon::today();

        // Get the current day of the week
        $currentDay = $today->format('l');

        // Get the users whose grocery day matches the current day
        $users = User::where('groceries_day', $currentDay)->get();

        // Delete groceries for users whose grocery day is today (Sunday)
        Grocery::whereIn('user_id', $users->pluck('id'))
            ->whereDate('week_start_date', '<=', $deleteDay->subDays(2)->format('Y-m-d'))
            ->forceDelete();

        // Get the day to create the new grocery list (Saturday, one day before grocery day)
        $mailDay = $today->addDay()->format('l'); // Get tomorrow's day

        // Get the users whose grocery day is tomorrow (for sending new list email)
        $users = User::where('groceries_day', $mailDay)->get();
        if ($users->isEmpty()) {
            $this->info("No users found with groceries day: $mailDay");
            return;
        }


        // Start creating groceries for the next week
        $startDate = Carbon::tomorrow(); // Saturday, one day before grocery day (for new groceries)
        $endDate = Carbon::today()->addWeek(); // One week from Saturday

        foreach ($users as $user) {
            $user->groceries_start_date = Carbon::tomorrow();;
            $user->groceries_end_date = Carbon::today()->addWeek();
            $user->save();
            // Loop through the next week (Saturday to the next Saturday)
            while ($startDate->lt($endDate)) {

                // Prepare the request data
                $request = new \Illuminate\Http\Request();
                $request->merge([
                    'date' => $startDate->toDateString(),
                    'uuid' => $user->uuid,
                ]);

                // Schedule the dashboard (schedule dashboard for each day of the week)
                app(DashboardController::class)->scheduleDashboard($request);

                // Fetch recipe ingredients for the user
                $recipeIds = ScheduleRecipe::where('user_id', $user->id)
                    ->where('date', $startDate->toDateString())
                    ->pluck('recipe_id');

                $recipe = Helper::createGrocery($recipeIds, $user, $user->groceries_start_date, $user->groceries_end_date);
                // Move to the next day
                $startDate->addDay();
            }
        }

        // Send email with new grocery list to users
        foreach ($users as $user) {
            // Fetch groceries created today (for the new list)
            $groceries = Grocery::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->orderBy('name', 'asc')
                ->get();

            if ($groceries->isNotEmpty()) {
                // Send email with the new grocery list
                Mail::to($user->email)->send(new GroceryDeletionNotification($user, $groceries));
                $this->info("Notification sent to user: {$user->email}");
            }
        }

        // Exit after the operation

        $this->info('Grocery list has been reset.');
        return Command::SUCCESS;
    }




}
