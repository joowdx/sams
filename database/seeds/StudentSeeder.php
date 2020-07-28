<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Student::class)->states('Bryan Bolo')->create();
        factory(App\Student::class)->states('Jude Pineda')->create();
        factory(App\Student::class)->states('Gene Philip Rellanos')->create();
        factory(App\Student::class)->states('John Lloyd Casia')->create();
        factory(App\Student::class)->states('Amilissa Araneta')->create();
        factory(App\Student::class)->states('James Andrew Dignadice')->create();
        factory(App\Student::class)->states('Jean Nikolai Roxas')->create();
        factory(App\Student::class)->states('Dhominic Arendain')->create();
        factory(App\Student::class)->states('Geraldin Cayode')->create();
        factory(App\Student::class)->states('Axel John Abear')->create();
        factory(App\Student::class)->states('Bernadette Allion')->create();
        factory(App\Student::class)->states('Ian Joey Cobol')->create();
        factory(App\Student::class)->states('Yvvone Love Decina')->create();
        factory(App\Student::class)->states('King Carlo Dela Cerna')->create();
        // factory(App\Student::class)->states('Steven Glenn Gabihan')->create();
        factory(App\Student::class)->states('Christian Lloyd Lape')->create();
        factory(App\Student::class)->states('Archeval Laran')->create();
        // factory(App\Student::class)->states('Mark Anthony Libres')->create();
        factory(App\Student::class)->states('Josebelle Linggoan')->create();
        // factory(App\Student::class)->states('Francis Fritz Nequin')->create();
        factory(App\Student::class)->states('Jasson Nequin')->create();
        // factory(App\Student::class)->states('Armando Gabriel Nieve')->create();
        // factory(App\Student::class)->states('Rachel Grace Pulvera')->create();
        // factory(App\Student::class)->states('Arnulfo Sienes')->create();
        // factory(App\Student::class)->states('Jann Sobejana')->create();
        // factory(App\Student::class)->states('John Michael Tecson')->create();
        factory(App\Student::class)->states('Jade Michael Tenorio')->create();
        // factory(App\Student::class)->states('Michael Angelo Torrepalma')->create();
        factory(App\Student::class)->states('Vincent Romeo Vivas')->create();
        factory(App\Student::class)->states('Karl Lyle Balbuena')->create();
        // factory(App\Student::class)->states('Jay Lord Largo')->create();

    }
}
