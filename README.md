# GX DOJO GREEN, PHASE 3 IOT

Kelompok PBL IF-13 DAN IF-14, Beranggotakan! 🚀

<br>
3312301016 - Marsya Huriyah Ibtisamah
<br>
3312301056 - Nania Prima Citra Aulia
<br>
3312301053 - Yurisha Anindya 
<br>
3312301011 - Elvira Fitriayu Ardina 
<br>
3312301060 - Muhammad Farrel Ardanto
<br>
3312301064 - Ahmad Candra Ramadhan
<br>
3312301088 - Irmayani
<br>
3312301067 - Ardian Zahran
<br>
3312301068 - Muhammad Haziq Afif Hidayat
<br>
3312311003 - Tarich Ziad
<br>

## About the App
<!-- gambar taro di src -->
<img align="center" alt="Coding" width="400" src=""> 


## Initial Setup to Launch the App

1. **Clone the Project**: Start by cloning the project from your friend's GitHub repository to your local machine.

   ```bash
   git clone https://github.com/TzyProgrammer/IoT-Panasonic.git
   ```

2. **Navigate to the project directory**
   ```bash
   cd GX_DOJO_WEB

3. **Install Composer Dependencies**: Navigate to the newly cloned project directory and install Composer dependencies.

   ```bash
   composer install
   ```

4. **Update Composer Autoload and Dependencies**
   
   ```bash
   composer dump-autoload
   composer update
   ```

5. **Launch The App**
   ```bash
   php artisan serve
   ```
## Handling Errors

If you encounter errors, follow these steps:

1. **Recovery Procedure**:

   ```bash
   php artisan serve
   ```

2. **If you encounter an Error Code 500**:

   - Rename `.env-example` to `.env`.
   - Set `APP_DEBUG=true` in the `.env` file.

3. **Generate New Application Key**:

   ```bash
   php artisan key:generate
   ```

4. **Restart the Server**:

   ```bash
   php artisan serve
   ```


