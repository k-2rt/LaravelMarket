<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('category')->nullable()->default('0')->after('password');
            $table->string('coupon')->nullable()->default('0')->after('category');
            $table->string('product')->nullable()->default('0')->after('coupon');
            $table->string('article')->nullable()->default('0')->after('product');
            $table->string('order')->nullable()->default('0')->after('article');
            $table->string('other')->nullable()->default('0')->after('order');
            $table->string('report')->nullable()->default('0')->after('other');
            $table->string('return')->nullable()->default('0')->after('report');
            $table->string('role')->nullable()->default('0')->after('return');
            $table->string('contact')->nullable()->default('0')->after('role');
            $table->string('comment')->nullable()->default('0')->after('contact');
            $table->string('setting')->nullable()->default('0')->after('comment');
            $table->string('type')->nullable()->default('0')->after('setting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('coupon');
            $table->dropColumn('product');
            $table->dropColumn('article');
            $table->dropColumn('order');
            $table->dropColumn('other');
            $table->dropColumn('report');
            $table->dropColumn('return');
            $table->dropColumn('role');
            $table->dropColumn('contact');
            $table->dropColumn('comment');
            $table->dropColumn('setting');
            $table->dropColumn('type');
        });
    }
}
