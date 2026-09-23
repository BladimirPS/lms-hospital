<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Exam;
use App\Models\Question;
use App\Models\AnswerOption;
use App\Models\User;
use App\Models\Section;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $creator = User::where('email', 'admin@email.com')->first();

        // ── CURSO 1: Higiene de Manos ─────────────────────────
        $course1 = Course::create([
            'title'          => 'Higiene de Manos y Prevención de IAAS',
            'description'    => 'Curso sobre la correcta técnica de higiene de manos para prevenir infecciones asociadas a la atención en salud.',
            'type'           => 'talk',
            'version'        => 1,
            'is_free_choice' => false,
            'generates_diploma' => true,
            'minimum_score'  => 70,
            'start_date'     => now()->toDateString(),
            'due_date'       => now()->addDays(30)->toDateString(),
            'status'         => 'published',
            'creator_id'     => $creator->id,
        ]);

        // Módulo 1
        $module1 = Module::create([
            'course_id' => $course1->id,
            'title'     => 'Fundamentos de Higiene de Manos',
            'order'     => 1,
        ]);

        Lesson::create([
            'module_id'   => $module1->id,
            'title'       => 'Cuándo lavarse las manos',
            'type'        => 'article',
            'description' => 'Momentos clave para el lavado de manos según la OMS.',
            'content'     => '<h2>Los 5 momentos de higiene de manos</h2><p>Según la OMS, existen 5 momentos clave en los que el personal de salud debe realizar la higiene de manos:</p><ul><li><p>Antes del contacto con el paciente</p></li><li><p>Antes de realizar una tarea limpia o aséptica</p></li><li><p>Después del riesgo de exposición a fluidos corporales</p></li><li><p>Después del contacto con el paciente</p></li><li><p>Después del contacto con el entorno del paciente</p></li></ul>',
            'order'       => 1,
        ]);

        Lesson::create([
            'module_id'   => $module1->id,
            'title'       => 'Técnica correcta de lavado de manos',
            'type'        => 'youtube_video',
            'description' => 'Video demostrativo de la técnica correcta.',
            'youtube_url' => 'https://www.youtube.com/watch?v=3PmVJQUCm4E',
            'order'       => 2,
        ]);

        // Módulo 2
        $module2 = Module::create([
            'course_id' => $course1->id,
            'title'     => 'Prevención de IAAS',
            'order'     => 2,
        ]);

        Lesson::create([
            'module_id'   => $module2->id,
            'title'       => 'Qué son las IAAS y por qué importan',
            'type'        => 'article',
            'description' => 'Definición y relevancia de las infecciones asociadas a la atención en salud.',
            'content'     => '<h2>Infecciones Asociadas a la Atención en Salud</h2><p>Las IAAS son infecciones que el paciente adquiere mientras recibe tratamiento en un establecimiento de salud y que no estaban presentes ni en período de incubación en el momento de la admisión.</p><p>La higiene de manos es la medida más eficaz para prevenirlas.</p>',
            'order'       => 1,
        ]);

        // Examen
        $exam1 = Exam::firstOrCreate(['course_id' => $course1->id]);

        $q1 = Question::create([
            'exam_id' => $exam1->id,
            'text'    => '¿Cuántos momentos de higiene de manos establece la OMS?',
            'type'    => 'single_answer',
            'order'   => 1,
        ]);
        AnswerOption::create(['question_id' => $q1->id, 'text' => '3 momentos', 'is_correct' => false]);
        AnswerOption::create(['question_id' => $q1->id, 'text' => '5 momentos', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q1->id, 'text' => '7 momentos', 'is_correct' => false]);

        $q2 = Question::create([
            'exam_id' => $exam1->id,
            'text'    => '¿La higiene de manos es la medida más eficaz para prevenir las IAAS?',
            'type'    => 'true_false',
            'order'   => 2,
        ]);
        AnswerOption::create(['question_id' => $q2->id, 'text' => 'Verdadero', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q2->id, 'text' => 'Falso', 'is_correct' => false]);

        $q3 = Question::create([
            'exam_id' => $exam1->id,
            'text'    => '¿Cuáles de los siguientes son momentos correctos para la higiene de manos?',
            'type'    => 'multiple_choice',
            'order'   => 3,
        ]);
        AnswerOption::create(['question_id' => $q3->id, 'text' => 'Antes del contacto con el paciente', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q3->id, 'text' => 'Después del contacto con el paciente', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q3->id, 'text' => 'Al salir del hospital', 'is_correct' => false]);
        AnswerOption::create(['question_id' => $q3->id, 'text' => 'Después de exposición a fluidos', 'is_correct' => true]);

        // Asignar secciones
        $secciones = Section::whereIn('name', ['Cirugía', 'Emergencia', 'Cuidados Generales', 'Anestesia'])->get();
        $course1->sections()->sync($secciones->pluck('id'));

        // ── CURSO 2: Bioseguridad ─────────────────────────────
        $course2 = Course::create([
            'title'          => 'Normas de Bioseguridad Hospitalaria',
            'description'    => 'Principios y prácticas de bioseguridad para el personal hospitalario.',
            'type'           => 'workshop',
            'version'        => 1,
            'is_free_choice' => true,
            'generates_diploma' => true,
            'minimum_score'  => 75,
            'start_date'     => now()->toDateString(),
            'due_date'       => now()->addDays(45)->toDateString(),
            'status'         => 'published',
            'creator_id'     => $creator->id,
        ]);

        $module3 = Module::create([
            'course_id' => $course2->id,
            'title'     => 'Principios de Bioseguridad',
            'order'     => 1,
        ]);

        Lesson::create([
            'module_id'   => $module3->id,
            'title'       => 'Universalidad y uso de barreras',
            'type'        => 'article',
            'description' => 'Principios básicos de bioseguridad hospitalaria.',
            'content'     => '<h2>Principios de Bioseguridad</h2><p>La bioseguridad se basa en tres principios fundamentales:</p><ul><li><p><strong>Universalidad:</strong> Las medidas deben aplicarse a todos los pacientes independientemente de su diagnóstico.</p></li><li><p><strong>Uso de barreras:</strong> EPP para evitar el contacto con fluidos y materiales potencialmente infecciosos.</p></li><li><p><strong>Medios de eliminación:</strong> Correcta disposición de residuos y materiales contaminados.</p></li></ul>',
            'order'       => 1,
        ]);

        Lesson::create([
            'module_id'   => $module3->id,
            'title'       => 'Uso correcto del EPP',
            'type'        => 'youtube_video',
            'description' => 'Demostración del uso correcto del equipo de protección personal.',
            'youtube_url' => 'https://www.youtube.com/watch?v=p6yYJcDCs9w',
            'order'       => 2,
        ]);

        $exam2 = Exam::firstOrCreate(['course_id' => $course2->id]);

        $q4 = Question::create([
            'exam_id' => $exam2->id,
            'text'    => '¿A quiénes aplica el principio de universalidad en bioseguridad?',
            'type'    => 'single_answer',
            'order'   => 1,
        ]);
        AnswerOption::create(['question_id' => $q4->id, 'text' => 'Solo a pacientes con enfermedades infecciosas', 'is_correct' => false]);
        AnswerOption::create(['question_id' => $q4->id, 'text' => 'A todos los pacientes sin excepción', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q4->id, 'text' => 'Solo al personal médico', 'is_correct' => false]);

        $q5 = Question::create([
            'exam_id' => $exam2->id,
            'text'    => '¿El EPP protege tanto al personal como al paciente?',
            'type'    => 'true_false',
            'order'   => 2,
        ]);
        AnswerOption::create(['question_id' => $q5->id, 'text' => 'Verdadero', 'is_correct' => true]);
        AnswerOption::create(['question_id' => $q5->id, 'text' => 'Falso', 'is_correct' => false]);
    }
}
