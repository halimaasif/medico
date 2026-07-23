<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            [
                "keywords" => "chest pain, chati me dard, dil me dard, shortness of breath, saans me masla",
                "condition_name" => "Acute Cardiac Condition / Angina",
                "severity_levels" => "High Criticality",
                "duration" => "Immediate Attention Required",
                "emergency_situation" => "Yes, high risk of myocardial infarction.",
                "medications" => [
                    ["name" => "Glyceryl Trinitrate (GTN Spray)", "description" => "Emergency spray placed sublingually to rapidly dilate coronary arteries."],
                    ["name" => "Aspirin (300mg)", "description" => "Chew immediately to reduce cardiovascular clot expansion."]
                ]
            ],
            [
                "keywords" => "headache, sar dard, vomiting, ulti, migraine, tez roshni se masla",
                "condition_name" => "Migraine (Aadha Sisi ka Dard)",
                "severity_levels" => "Moderate to Severe",
                "duration" => "4 to 72 hours if untreated",
                "emergency_situation" => "No, standard clinical intervention.",
                "medications" => [
                    ["name" => "Sumatriptan", "description" => "Tez sar dard aur migraine ke pathways ko rokne ke liye behtareen dawa hai."],
                    ["name" => "Ondansetron", "description" => "Sar dard ke saath aane wali ulti aur matli (nausea) ko khatam karti hai."]
                ]
            ],
            [
                "keywords" => "fever, bukhar, body pain, jism me dard, flu, nazla, zukan, cough, khansi",
                "condition_name" => "Viral Fever / Influenza",
                "severity_levels" => "Mild to Moderate",
                "duration" => "3 to 7 days",
                "emergency_situation" => "No, unless fever exceeds 103°F or breathing becomes difficult.",
                "medications" => [
                    ["name" => "Paracetamol (Panadol 500mg)", "description" => "Bukhar ko kam karne aur jism ke dard ko khatam karne ke liye din me 3 dafa."],
                    ["name" => "Arinac / Softin", "description" => "Flu, nazla, zukan aur naak band hone ki alamat ko relief dene ke liye."]
                ]
            ],
            [
                "keywords" => "stomach pain, pait me dard, loose motions, dast, diarrhea, vomiting, food poisoning",
                "condition_name" => "Gastroenteritis / Food Poisoning",
                "severity_levels" => "Moderate",
                "duration" => "1 to 3 days",
                "emergency_situation" => "No, unless severe dehydration occurs.",
                "medications" => [
                    ["name" => "ORS (Oral Rehydration Salts)", "description" => "Jism me paani aur namkiyat ki kami ko poora karne ke liye continuous use karein."],
                    ["name" => "Flagyl (Metronidazole 400mg)", "description" => "Stomach infection aur loose motions ko control karne ke liye behtareen antibacterial dawa."]
                ]
            ],
            [
                "keywords" => "typhoid, tez bukhar, thand lagna, jism tootna, severe weakness",
                "condition_name" => "Typhoid Fever (Miyadi Bukhar)",
                "severity_levels" => "Moderate to Severe",
                "duration" => "2 to 3 weeks if untreated",
                "emergency_situation" => "Yes, if high fever persists or intestinal pain starts.",
                "medications" => [
                    ["name" => "Cefixime (400mg) / Injection Ceftriaxone", "description" => "Salmonella typhi bacteria ko khatam karne ke liye 7 se 14 din ka antibiotic course."],
                    ["name" => "Paracetamol (Panadol Extra)", "description" => "Tez bukhar aur jism ke dard ko relief dene ke liye har 6 ghante baad."]
                ]
            ],
            [
                "keywords" => "kidney pain, gurde me dard, back flank pain, renal colic, vomiting with back pain",
                "condition_name" => "Renal Calculi / Kidney Stones",
                "severity_levels" => "Severe Pain",
                "duration" => "Acute episodes until stone passes",
                "emergency_situation" => "Yes, if complete urinary blockage or blood in urine occurs.",
                "medications" => [
                    ["name" => "Tab Ketonov (Ketorolac)", "description" => "Gurde ke shadeed dard (renal colic) ko control karne ke liye effective pain killer."],
                    ["name" => "Syp Citralka / Citrosoda", "description" => "Urine ki acidity ko balance karne aur tract ko relax karne ke liye."]
                ]
            ]
        ];

        foreach ($diseases as $disease) {
            Symptom::create($disease);
        }
    }
}