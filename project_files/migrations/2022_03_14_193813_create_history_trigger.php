<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER product_history_insert
        AFTER INSERT ON `products` FOR EACH ROW
        BEGIN
            INSERT INTO product_histories (`product_id`, `name`, `price`, `cover`, `process`, `date`)
            VALUES (NEW.id,NEW.name,NEW.price,NEW.cover, "insert", now());
        END;

        CREATE TRIGGER product_history_update
        AFTER UPDATE ON `products` FOR EACH ROW
        BEGIN
            INSERT INTO product_histories (`product_id`, `name`, `price`, `cover`, `process`, `date`)
            VALUES (NEW.id,NEW.name,NEW.price,NEW.cover, "update", now());
        END;

        CREATE TRIGGER product_history_delete
        BEFORE  DELETE ON `products` FOR EACH ROW
        BEGIN
            INSERT INTO product_histories (`product_id`, `name`, `price`, `cover`, `process`, `date`)
            VALUES (OLD.id,OLD.name,OLD.price,OLD.cover, "delete", now());
        END;

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `product_history_insert`');
        DB::unprepared('DROP TRIGGER `product_history_update`');
        DB::unprepared('DROP TRIGGER `product_history_delete`');
    }
}
