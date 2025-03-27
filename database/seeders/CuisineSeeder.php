<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cuisine;
use DB;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Cuisine::truncate();
        $cuisines = [
            [
                'name' => 'African',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-015d744c02d7e64941b13893613d654c.jpg'
            ],
            [
                'name' => 'American',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-c1ef4d08208eaf4942bba5c635e20620.jfif'
            ],
            [
                'name' => 'Asian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-dde18ba1a67bd3032628b93cbfad2baa.jpg'
            ],
            [
                'name' => 'Australian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-4f382cecf343c478c0660a723eaa524b.jpg'
            ],
            [
                'name' => 'British',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-4fca7551b87e966743fcb16c51ee9cb6.jfif'
            ],
            [
                'name' => 'Chinese',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-ae5bc65a7dff92ca936c35301c26ef0e.jfif'
            ],
            [
                'name' => 'Creole',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-0bfd9b630f6b47b9eef8f7c7912ac21b.jfif'
            ],
            [
                'name' => 'European',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-c9eeb6ec8b57e751d527ed9f8376438b.jfif'
            ],
            [
                'name' => 'French',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-2aa21f5998330953e9e9fc99a9e82c03.jfif'
            ],
            [
                'name' => 'Fusion',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-8f6db91f536cc9f94106abf96a53b272.jfif'
            ],
            [
                'name' => 'German',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-be743b83b1b42a4b19477c7be992277f.jfif'
            ],
            [
                'name' => 'Greek',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-a1c83a19650ae02172cd3bea4c340dd6.jfif'
            ],
            [
                'name' => 'Hungarian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-e49208a6f7c6b0a4815f46e7b59f7aa0.jfif'
            ],
            [
                'name' => 'Indian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-58e17707f7c1550b4d8803ee358507a0.jfif'
            ],
            [
                'name' => 'Indonesian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-88cb5ff68ab3d301321e5dfff13b3475.jfif'
            ],
            [
                'name' => 'Irish',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-d158bb634cd6bffdd4ee61728d02ed15.jfif'
            ],
            [
                'name' => 'Italian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-4714d6da8fa34ed642374cd82957714d.jfif'
            ],
            [
                'name' => 'Japanese',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-94e32d7c935dc7bb94e5194835cf227f.jfif'
            ],
            [
                'name' => 'Korean',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-ac78eefd846d1941299727ae8b0db7df.jfif'
            ],
            [
                'name' => 'Lebanese',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-7a78175e7b61510dfc441b05cee679d5.jfif'
            ],
            [
                'name' => 'Malaysian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-d5173f6f3aae78bff725712f24bb7f92.jfif'
            ],
            [
                'name' => 'Mediterranean',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-1bbd5187019dae6d45caf56bbb47d8a4.jfif'
            ],
            [
                'name' => 'Mexican',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-e28cd0cad28f54425bcfd8501f194330.jfif'
            ],
            [
                'name' => 'Middle Eastern',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-f95a6ba9cd920489e97d8d0736843e3c.jfif'
            ],
            [
                'name' => 'Portuguese',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-46c55d8edf6c1b846836c12ec2e6bafa.jfif'
            ],
            [
                'name' => 'Russian',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-12e420c8a031cb294d8ede1689d24c8c.jfif'
            ],
            [
                'name' => 'Spanish',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-7e4e5c27fca1686ccf1dd320a8f86431.jfif'
            ],
            [
                'name' => 'Sri Lankan',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-a86766743a095d7f3709eb974d7ff00d.jfif'
            ],
            [
                'name' => 'Thai',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-95d79ee2c5302b9c68c55f0bb423d99e.jfif'
            ],
            [
                'name' => 'Turkish',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-5eedfbbb80a60272863efaeaab497c16.jfif'
            ],
            [
                'name' => 'Vietnamese',
                'status' => 'active',
                'user_id' => 1,
                'file_url' => 'cuisine/2024/01/project_name-45c264e9fc0126a280dc3fc74236c0b3.jfif'
            ]
        ];

        // Use a loop to insert the data into the "cuisines" table
        foreach ($cuisines as $cuisine) {
            Cuisine::create($cuisine);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
