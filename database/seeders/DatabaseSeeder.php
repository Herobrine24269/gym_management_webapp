<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Membership;
use App\Models\PaymentHistory;
use App\Models\Post;
use App\Models\DietPlan;
use App\Models\Notification;
use App\Models\Setting;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Initial Settings
        Setting::instance();

        // 2. Admin User
        $admin = User::create([
            'name' => 'Alex Rivera',
            'email' => 'admin@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15550001111',
            'role' => 'admin',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(12)->toDateString(),
            'status' => 'active',
        ]);

        // 3. Trainer Users
        $trainer1 = User::create([
            'name' => 'Marcus Vance',
            'email' => 'm.vance@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15552345678',
            'role' => 'trainer',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(8)->toDateString(),
            'status' => 'active',
        ]);

        $trainer2 = User::create([
            'name' => 'Elena Rostova',
            'email' => 'e.rostova@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15558765432',
            'role' => 'trainer',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(6)->toDateString(),
            'status' => 'active',
        ]);

        // 4. Member Users & Memberships
        // Member 1: Paid status (All-Access Pro Monthly)
        $member1 = User::create([
            'name' => 'Jordan Miller',
            'email' => 'jordan.m@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15559482011',
            'role' => 'member',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(3)->toDateString(),
            'status' => 'active',
        ]);
        $ms1 = Membership::create([
            'user_id' => $member1->id,
            'plan_name' => 'All-Access Pro',
            'plan_type' => 'monthly',
            'monthly_fee' => 79.99,
            'last_paid_date' => Carbon::now()->subDays(10)->toDateString(),
            'next_due_date' => Carbon::now()->addDays(20)->toDateString(),
            'status' => 'paid',
            'assigned_trainer_id' => $trainer1->id,
        ]);
        PaymentHistory::create([
            'membership_id' => $ms1->id,
            'amount' => 79.99,
            'paid_on' => Carbon::now()->subDays(10)->toDateString(),
            'payment_method' => 'jazzcash',
            'transaction_id' => 'JC8492019482',
            'invoice_no' => 'FC-INV-2026-0001',
            'marked_by' => null,
        ]);

        // Member 2: Due Soon status (VIP Performance Yearly)
        $member2 = User::create([
            'name' => 'Samantha Reed',
            'email' => 'samantha.r@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15553129844',
            'role' => 'member',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(2)->toDateString(),
            'status' => 'active',
        ]);
        $ms2 = Membership::create([
            'user_id' => $member2->id,
            'plan_name' => 'VIP Performance',
            'plan_type' => 'yearly',
            'monthly_fee' => 1236.00,
            'last_paid_date' => Carbon::now()->subDays(362)->toDateString(),
            'next_due_date' => Carbon::now()->addDays(3)->toDateString(),
            'status' => 'due_soon',
            'assigned_trainer_id' => $trainer1->id,
        ]);
        PaymentHistory::create([
            'membership_id' => $ms2->id,
            'amount' => 1236.00,
            'paid_on' => Carbon::now()->subDays(362)->toDateString(),
            'payment_method' => 'easypaisa',
            'transaction_id' => 'EP9482018471',
            'invoice_no' => 'FC-INV-2026-0002',
            'marked_by' => null,
        ]);

        // Member 3: Unpaid / Overdue status
        $member3 = User::create([
            'name' => 'David Vance',
            'email' => 'david.vance@fitcore.gym',
            'password' => Hash::make('password123'),
            'phone' => '+15557891234',
            'role' => 'member',
            'profile_photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            'join_date' => Carbon::now()->subMonths(5)->toDateString(),
            'status' => 'active',
        ]);
        $ms3 = Membership::create([
            'user_id' => $member3->id,
            'plan_name' => 'Basic Fit',
            'plan_type' => 'monthly',
            'monthly_fee' => 49.99,
            'last_paid_date' => Carbon::now()->subDays(34)->toDateString(),
            'next_due_date' => Carbon::now()->subDays(4)->toDateString(),
            'status' => 'unpaid',
            'assigned_trainer_id' => $trainer2->id,
        ]);

        // 5. Sample Notifications
        Notification::create([
            'type' => 'fee_due',
            'member_id' => $member3->id,
            'message' => 'David Vance has completed their 30 days, payment due ($49.99)',
            'is_resolved' => false,
        ]);

        // 6. Sample Diet Plans
        DietPlan::create([
            'trainer_id' => $trainer1->id,
            'title' => 'Lean Muscle Shred Plan',
            'category' => 'muscle_gain',
            'description' => 'Designed for body recomposition with 40% protein, 35% carbs, and 25% healthy fats.',
            'breakfast' => '6 Egg Whites + 2 Whole Eggs, 1 Cup Oatmeal with Berries, 1 tbsp Almond Butter',
            'lunch' => '250g Grilled Chicken Breast, 1.5 Cups Jasmine Rice, Roasted Asparagus & Olive Oil',
            'dinner' => '220g Baked Atlantic Salmon Fillet, Sweet Potato Mash, Mixed Green Salad',
            'snacks' => '1 Scoop Whey Isolate Protein, 1 Large Banana, 30g Rice Cakes with Honey',
            'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
        ]);

        DietPlan::create([
            'trainer_id' => $trainer2->id,
            'title' => 'Keto Peak Endurance',
            'category' => 'weight_loss',
            'description' => 'High fat, ultra-low carb ketogenic protocol for rapid fat oxidation and sustained energy.',
            'breakfast' => '3 Scrambled Eggs in Butter, 4 Strips Bacon, Avocado Slice',
            'lunch' => 'Grilled Ribeye Steak, Spinach Salad with Extra Virgin Olive Oil & Macadamia Nuts',
            'dinner' => 'Seared Wild Salmon, Grilled Zucchini, Butter-drizzled Broccoli',
            'snacks' => 'Handful Walnut Kernels, String Cheese, Bone Broth',
            'image_url' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=600&q=80',
        ]);

        // 7. Sample Posts
        Post::create([
            'author_id' => $trainer1->id,
            'title' => 'Saturday Morning High-Intensity Conditioning',
            'description' => '🔥 Reminder to all members: Saturday Conditioning starts at 8:00 AM sharp! Bring your hydration powders and get ready to push past your personal records.',
            'image_url' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&w=800&q=80',
        ]);
    }
}
