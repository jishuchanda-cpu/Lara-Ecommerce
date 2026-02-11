<?php

use App\Models\User;

echo "=== Checking Users in Database ===" . PHP_EOL . PHP_EOL;

$users = User::all();

if ($users->isEmpty()) {
    echo "❌ NO USERS FOUND! You need to run: php artisan db:seed" . PHP_EOL;
}
else {
    echo "✅ Found " . $users->count() . " user(s):" . PHP_EOL . PHP_EOL;

    foreach ($users as $user) {
        echo "ID: {$user->id}" . PHP_EOL;
        echo "Name: {$user->name}" . PHP_EOL;
        echo "Email: {$user->email}" . PHP_EOL;
        echo "Role: {$user->role}" . PHP_EOL;
        echo "---" . PHP_EOL;
    }
}

echo PHP_EOL . "=== Testing Password Hash ===" . PHP_EOL;
$testUser = User::where('email', 'admin@admin.com')->first();
if ($testUser) {
    echo "✅ Admin user exists" . PHP_EOL;
    echo "Password hash: " . substr($testUser->password, 0, 20) . "..." . PHP_EOL;

    // Test if 'password' works
    if (Hash::check('password', $testUser->password)) {
        echo "✅ Password 'password' is CORRECT" . PHP_EOL;
    }
    else {
        echo "❌ Password 'password' does NOT match" . PHP_EOL;
    }
}
else {
    echo "❌ Admin user not found - run: php artisan db:seed" . PHP_EOL;
}
