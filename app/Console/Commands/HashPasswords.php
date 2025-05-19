<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
  protected $signature = 'passwords:hash';
  protected $description = 'Hash all passwords and generate a JSON file';

  public function handle()
  {
    $csvPath = base_path('passwords.csv');
    $jsonPath = base_path('passwords.json');

    if (!file_exists($csvPath)) {
      $this->error("CSV file not found at: $csvPath");
      return 1;
    }

    $rows = array_map('str_getcsv', file($csvPath));
    $header = array_map('trim', $rows[0]);
    $data = array_slice($rows, 1);

    $passwords = [];

    foreach ($data as $row) {
      $row = array_map('trim', $row);
      $rowAssoc = array_combine($header, $row);

      if (!isset($rowAssoc['date'], $rowAssoc['password'])) {
        $this->warn('Invalid row: ' . json_encode($row));
        continue;
      }

      // Convert date format to Y-m-d (required by your validator)
      $dateObj = \DateTime::createFromFormat('d.m.Y', $rowAssoc['date']);
      if (!$dateObj) {
        $this->warn("Invalid date format: {$rowAssoc['date']}");
        continue;
      }

      $formattedDate = $dateObj->format('Y-m-d');
      $hashedPassword = password_hash($rowAssoc['password'], PASSWORD_DEFAULT);

      $passwords[$formattedDate] = $hashedPassword;
    }

    file_put_contents($jsonPath, json_encode($passwords, JSON_PRETTY_PRINT));
    $this->info("Hashed passwords saved to: $jsonPath");

    return 0;
  }
}
