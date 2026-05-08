<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                "employee_code" => "EMP001",
                "first_name" => "John",
                "last_name" => "Doe",
                "gender" => "m",
                "phone_number" => "123-456-7890",
                "department" => "IT",
                "job_title" => "Software Engineer",
                "employment_type" => "full-time",
                "status" => "active",
                "email" => "john.doe@example.com",
                "date_joined" => "2023-01-15 09:00:00",
                "probation_end_date" => "2023-07-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP002",
                "first_name" => "Jane",
                "last_name" => "Smith",
                "gender" => "f",
                "phone_number" => "098-765-4321",
                "department" => "IT",
                "job_title" => "Data analyst",
                "employment_type" => "full-time",
                "status" => "active",
                "email" => "jane.smith@example.com",
                "date_joined" => "2023-02-15 09:00:00",
                "probation_end_date" => "2023-08-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP003",
                "first_name" => "Alice",
                "last_name" => "Johnson",
                "gender" => "f",
                "phone_number" => "555-123-4567",
                "department" => "Marketing",
                "job_title" => "Social Media Manager",
                "employment_type" => "full-time",
                "status" => "active",
                "email" => "alice.johnson@example.com",
                "date_joined" => "2023-02-15 09:00:00",
                "probation_end_date" => "2023-08-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP004",
                "first_name" => "Hannah",
                "last_name" => "Welson",
                "gender" => "f",
                "phone_number" => "535-723-4567",
                "department" => "Accounting",
                "job_title" => "Head accountant",
                "employment_type" => "full-time",
                "status" => "active",
                "email" => "hannah.welson@example.com",
                "date_joined" => "2022-02-15 09:00:00",
                "probation_end_date" => "2022-08-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP005",
                "first_name" => "James",
                "last_name" => "Dey",
                "gender" => "m",
                "phone_number" => "535-723-4347",
                "department" => "Accounting",
                "job_title" => "Stock taker",
                "employment_type" => "part-time",
                "status" => "active",
                "email" => "james.dey@example.com",
                "date_joined" => "2023-05-15 09:00:00",
                "probation_end_date" => "2023-11-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP006",
                "first_name" => "Clara",
                "last_name" => "Dumont",
                "gender" => "f",
                "phone_number" => "535-723-2909",
                "department" => "IT",
                "job_title" => "Lead software developer",
                "employment_type" => "contract",
                "status" => "active",
                "email" => "clara.dumont@example.com",
                "date_joined" => "2023-05-15 09:00:00",
                "probation_end_date" => "2023-11-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP007",
                "first_name" => "Kassandra",
                "last_name" => "Dumont",
                "gender" => "f",
                "phone_number" => "535-723-2909",
                "department" => "IT",
                "job_title" => "Network administrator",
                "employment_type" => "contract",
                "status" => "active",
                "email" => "kassie.dumont@example.com",
                "date_joined" => "2023-05-15 09:00:00",
                "probation_end_date" => "2023-11-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP008",
                "first_name" => "Leroy",
                "last_name" => "Mcbride",
                "gender" => "m",
                "phone_number" => "535-723-2909",
                "department" => "Sales",
                "job_title" => "Sales representative",
                "employment_type" => "contract",
                "status" => "active",
                "email" => "leroy.mcbride@example.com",
                "date_joined" => "2023-06-15 09:00:00",
                "probation_end_date" => "2023-12-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP009",
                "first_name" => "Shawn",
                "last_name" => "Parker",
                "gender" => "m",
                "phone_number" => "535-723-2909",
                "department" => "Sales",
                "job_title" => "Sales representative",
                "employment_type" => "contract",
                "status" => "inactive",
                "email" => "shawn.parker@example.com",
                "date_joined" => "2021-06-15 09:00:00",
                "probation_end_date" => "2021-12-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ],
            [
                "employee_code" => "EMP010",
                "first_name" => "Kimi",
                "last_name" => "Nakashima",
                "gender" => "f",
                "phone_number" => "535-723-2909",
                "department" => "Marketing",
                "job_title" => "Marketing specialist",
                "employment_type" => "contract",
                "status" => "active",
                "email" => "kimi.nakashima@example.com",
                "date_joined" => "2021-06-15 09:00:00",
                "probation_end_date" => "2021-12-15 09:00:00",
                "created_at" => date("Y-m-d H:i:s")
            ]
        ];

        $this->db->table('employees')->insertBatch($data);
    }

}