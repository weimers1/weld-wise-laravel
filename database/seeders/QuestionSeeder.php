<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'description' => 'What is the most common welding process used in construction?',
                'explanation' => 'SMAW (Shielded Metal Arc Welding) is widely used due to its versatility and portability.',
                'answers' => [
                    ['description' => 'SMAW (Stick welding)', 'is_correct' => true],
                    ['description' => 'GMAW (MIG welding)', 'is_correct' => false],
                    ['description' => 'GTAW (TIG welding)', 'is_correct' => false],
                    ['description' => 'FCAW (Flux-cored welding)', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'What does AWS stand for in welding?',
                'explanation' => 'AWS is the American Welding Society, which sets welding standards and certifications.',
                'answers' => [
                    ['description' => 'American Welding Society', 'is_correct' => true],
                    ['description' => 'Advanced Welding Systems', 'is_correct' => false],
                    ['description' => 'Automated Welding Solutions', 'is_correct' => false],
                    ['description' => 'Arc Welding Standards', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Which gas is commonly used for GTAW welding?',
                'explanation' => 'Argon is the most common shielding gas for GTAW because it provides excellent arc stability.',
                'answers' => [
                    ['description' => 'Argon', 'is_correct' => true],
                    ['description' => 'Carbon Dioxide', 'is_correct' => false],
                    ['description' => 'Oxygen', 'is_correct' => false],
                    ['description' => 'Nitrogen', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'What is the typical voltage range for SMAW welding?',
                'explanation' => '20-40 volts is the standard range for most SMAW applications.',
                'answers' => [
                    ['description' => '20-40 volts', 'is_correct' => true],
                    ['description' => '50-70 volts', 'is_correct' => false],
                    ['description' => '10-20 volts', 'is_correct' => false],
                    ['description' => '80-100 volts', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Which welding defect is caused by insufficient penetration?',
                'explanation' => 'Lack of fusion occurs when the weld metal does not properly fuse with the base metal.',
                'answers' => [
                    ['description' => 'Lack of fusion', 'is_correct' => true],
                    ['description' => 'Porosity', 'is_correct' => false],
                    ['description' => 'Undercut', 'is_correct' => false],
                    ['description' => 'Spatter', 'is_correct' => false],
                ]
            ]
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'description' => $questionData['description'],
                'explanation' => $questionData['explanation']
            ]);

            foreach ($questionData['answers'] as $index => $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'description' => $answerData['description'],
                    'order' => $index + 1,
                    'is_correct' => $answerData['is_correct']
                ]);
            }
        }
    }
}