<?php

use Illuminate\Support\Facades\DB;
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
        DB::statement("        
            CREATE OR REPLACE VIEW public.view_aeropuerto_expensa
            AS
            SELECT AE.ID,
                   AE.AEROPUERTO,
	               AE.EXPENSA,
                   A.DESCRIPCION AS DESC_AEROPUERTO, 
                   AE.FACTOR   
              FROM AEROPUERTO_EXPENSA AE
             INNER JOIN AEROPUERTO A ON A.ID = AE.AEROPUERTO
             INNER JOIN EXPENSA E ON E.ID = AE.EXPENSA
             ORDER BY A.ID;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_aeropuerto_expensa');
    }
};
