<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            (object) [
                'title' => 'Dampak Kekerasan pada Anak yang Tidak Boleh Diabaikan',
                'content' => '<p class="text-gray-800">Dampak kekerasan pada anak sering kali diabaikan, bahkan tak banyak yang menyadarinya. Padahal, anak korban kekerasan berisiko mengalami gangguan kesehatan fisik dan mental, hingga mengalami penurunan kualitas hidup.</p><p class="text-gray-800"> </p><p class="text-gray-800">Hingga kini kekerasan pada anak menjadi salah satu kasus yang memerlukan perhatian lebih. Kasus kekerasan terhadap anak masih sering ditemukan dalam berbagai bentuk, seperti penyiksaan, penelantaran, hingga kekerasan seksual.<br><br><strong class="font-bold">Jenis- Jenis Kekerasan pada Anak</strong><br><br><strong class="font-bold">1. Kekerasan Fisik</strong></p><p class="text-gray-800"> </p><p class="text-gray-800">Kekerasan fisik merupakan jenis kekerasan pada anak yang paling sering terjadi. Tanpa disadari, terkadang orang tua menggunakan kekerasan dengan dalih untuk mendisiplinkan anak. Padahal, cara ini justru akan menyakitinya.</p><p class="text-gray-800"> </p><p class="text-gray-800">Sejumlah contoh kekerasan fisik pada anak adalah memukul, melemparkan benda keras, dan sebagainya. Dampak kekerasan fisik pada anak di antaranya luka fisik berupa luka terbuka ataupun lebam pada tubuh, serta memunculkan rasa trauma.</p><p class="text-gray-800"> </p><p class="text-gray-800"><strong class="font-bold">2. Kekerasan Emosional</strong></p><p class="text-gray-800"> </p><p class="text-gray-800">Kekerasan emosional memang tidak melukai anak secara fisik, namun perilaku ini akan menyerang mental anak. Bentuk kekerasan emosional cukup beragam, seperti kekerasan verbal yang mencakup berteriak, mengancam, hingga mempermalukan anak.</p><p class="text-gray-800"> </p><p class="text-gray-800">Selain itu, jarang melakukan kontak fisik, seperti mengelus, memeluk, atau mencium anak juga termasuk dalam kekerasan emosional. Anak yang mengalami perlakukan ini cenderung kehilangan kepercayaan diri, menarik diri dari lingkungan, dan gelisah.</p><p class="text-gray-800"> </p><p class="text-gray-800"><strong class="font-bold">3. Kekerasan Seksual</strong></p><p class="text-gray-800"> </p><p class="text-gray-800">Kekerasan seksual tidak hanya bisa dialami oleh orang dewasa saja. Bahkan, tak jarang kasus ini terjadi pada anak-anak di bawah umur. Perlu diketahui bahwa kekerasan seksual tidak selalu diartikan sebagai sentuhan.</p><p class="text-gray-800"> </p><p class="text-gray-800">Pasalnya, mengekspos anak pada konteks seksual atau menggunakan materi yang melecehkan juga termasuk dalam kekerasan seksual. Contoh lainnya adalah mengejek ukuran payudara anak di depan orang lain.</p><p class="text-gray-800"> </p><p class="text-gray-800">Hal yang seharusnya dilakukan orang tua untuk mencegah hal ini adalah mengenalkan anak seputar bagian-bagian tubuh yang bersifat privasi dan mengajarkan anak melindungi diri dari kekerasan seksual di luar rumah.</p><p class="text-gray-800"> </p><p class="text-gray-800">Selain itu, orang tua harus peka terhadap perubahan fisik pada anak yang menandakan adanya kekerasan seksual, seperti nyeri saat berjalan, permasalah pada organ intim, hingga kehamilan.</p><p class="text-gray-800"> </p><p class="text-gray-800"><strong class="font-bold">4. Penelantaran Anak</strong></p><p class="text-gray-800"> </p><p class="text-gray-800">Jenis kekerasan pada anak berikutnya adalah penelantaran. Pada dasarnya, setiap orang tua wajib untuk memberikan kasih sayang dan perlindungan pada anak, termasuk memenuhi kebutuhannya baik fisik maupun emosional. Apabila kewajiban tersebut diabaikan, maka bisa dianggap sebagai bentuk penelantaran anak.</p>',
                'url' => asset('images/seeders/dampak-kekerasan-pada-anak.jpg'),
            ],
            (object) [
                'title' => 'Apa Itu Depresi? Kenali Gejala, Penyebab & Cara Mengatasinya',
                'content' => '<p class="text-gray-800">“Eh Bid, ayok jadi mabar, nggak? Kok, lesu banget!”<br></p><p class="text-gray-800">“Nggak dulu deh, gue lagi depresi.”<br></p><p class="text-gray-800">“Eh, depresi kenapa, tuh? Cerita dong sini.”<br></p><p class="text-gray-800">“Tadi mau lari pagi gitu bareng temen, eh tapi taunya ujan. Nggak jadi lari deh kita.”<br></p><p class="text-gray-800">“Oalah.. itu mah bete doang kali.”<br></p><p class="text-gray-800">Hmm, siapa nih yang pernah ngerasa depresi kayak Abid di atas? Kalo menurut kamu, Abid itu benar-benar lagi depresi atau engga, ya? Kalo kamu mengalami percakapan yang serupa dengan teman kamu, apa yang bakal kamu lakukan?<br></p><p class="text-gray-800">Nah, buat kamu yang sering denger istilah depresi, tapi belum paham apa makna di baliknya, nggak usah bingung, ya. Yuk, simak pembahasan lengkapnya mengenai apa itu depresi dan maknanya berikut ini!<br><br><strong class="font-bold">Apa Itu Depresi?</strong><br></p><p class="text-gray-800"><strong class="font-bold">Arti depresi adalah sebuah gangguan kesehatan mental yang secara negatif mempengaruhi perasaan, pola pikir, dan perilaku seseorang</strong>. Depresi dapat menyebabkan suasana hati yang terus menerus merasa sedih dan tertekan, sehingga menyebabkan turunnya produktivitas dalam kegiatan sehari-hari.<br><br>Kalo menurut kamu, yang Abid rasakan di atas dapat dikatakan sebagai depresi atau enggak? Jawabannya belum tentu, ya.<br><br>Salah satu hal yang paling sering menyebabkan kebingungan adalah <strong class="font-bold">mengalami depresi berbeda dengan merasa sedih atau kecewa</strong>. Semua orang pasti pernah merasa sedih atau kecewa. Namun, tidak semua orang yang mengalami hal ini dikatakan mengidap depresi, ya.&nbsp;<br></p><p class="text-gray-800">Saat kamu merasa sedih, kamu dapat menghilangkan rasa sedih tersebut dengan banyak hal, bukan? Netflix-an bareng teman, makan makanan favorit, jalan-jalan ke tempat baru, semua hal itu bisa membuat kamu merasa lebih baik. Tapi, lain halnya untuk orang yang mengidap depresi.&nbsp;<br></p><p class="text-gray-800">Seseorang dapat dikatakan mengidap depresi apabila telah mendapat diagnosis dari dokter atau psikiater. <br><br>Apabila mengidap depresi, seseorang dapat mengalami kesedihan dan kekecewaan mendalam yang dapat berlangsung hingga berminggu-minggu. Ketika melakukan hal yang biasa disukai, belum tentu hal itu dapat mengatasi depresi.</p>',
                'url' => asset('images/seeders/apa-itu-depresi.jpg'),
            ],
        ];

        $user = User::where('email', 'admin@gmail.com')->first();

        foreach ($articles as $article) {
            $dataExists = Article::where('title', $article->title)->exists();

            if (!$dataExists) {
                $imageName = $this->downloadImage($article->url);

                Article::create([
                    'slug' => Str::slug($article->title),
                    'title' => $article->title,
                    'content' => $article->content,
                    'is_featured' => 1,
                    'image' => $imageName,
                    'user_id' => $user->id
                ]);
            } else {
                $this->command->info('Article already exists.');
            }
        }
    }

    private function downloadImage(string $url): string
    {
        $response = Http::get($url);
        $extension = pathinfo($url, PATHINFO_EXTENSION); // Dapatkan ekstensi gambar dari URL
        $imageName = Str::random(10) . '.' . $extension; // Buat nama acak untuk gambar dengan ekstensi yang sama
        $imagePath = 'public/articles/' . $imageName;

        if ($response->successful()) {
            // Simpan gambar ke storage
            Storage::put($imagePath, $response->body());
        }

        return $imageName;
    }
}
