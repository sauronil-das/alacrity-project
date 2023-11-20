<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained;
            $table->integer('amount');
            $table->dateTime('loan_date');
            $table->enum('repayment_frequency', ['Daily', 'Weekly', 'Bi-Weekly', 'Monthly']);
            $table->decimal('interest_rate', 10, 2);
            $table->integer('repayment_amount');
            $table->enum('loan_status', ['Approvel', 'Pending', 'Rejected',]);
            $table->enum('repayment_status', ['Open', 'Paid']);
            // $table->integer('remaining_payments'); -- Calculated Field
            // $table->integer('final_repayment_date'); -- Calculated Field

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
