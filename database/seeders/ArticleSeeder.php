<?php

namespace Database\Seeders;

use App\Models\Article;
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
                'title' => 'The Impact of Domestic Violence on Children',
                'content' => 'Domestic violence has far-reaching effects on children, leading to emotional and psychological trauma. Understanding these impacts is crucial for providing the necessary support and intervention.',
                'url' => 'https://dixonsociety.ca/wp-content/uploads/2020/03/FINAL-Children-and-VAW-T-1.png',
            ],
            (object) [
                'title' => 'Breaking the Silence: Women Speak Out Against Abuse',
                'content' => 'Women from various backgrounds share their stories of abuse and how they have found strength and support to rebuild their lives. Their voices highlight the importance of awareness and advocacy.',
                'url' => 'https://storage.googleapis.com/asklegal-my/uploads/post/image/178/home_banner_a97c.jpg',
            ],
            (object) [
                'title' => 'Understanding Anxiety and Depression in Teens',
                'content' => 'Mental health issues like anxiety and depression are increasingly common among teenagers. Early identification and intervention are key to helping teens navigate these challenges.',
                'url' => 'https://www.sandstonecare.com/wp-content/uploads/2023/03/mixed-anxiety-and-depressive-disorder-MADD.png',
            ],
            (object) [
                'title' => 'Community Efforts to Combat Child Abuse',
                'content' => 'Local communities are coming together to create safe environments for children by raising awareness, providing resources, and supporting victims of child abuse.',
                'url' => 'https://preventchildabuse.org/wp-content/uploads/2022/03/featuredimage.png',
            ],
            (object) [
                'title' => 'The Role of Therapy in Healing Trauma',
                'content' => 'Therapy can be a powerful tool in healing from trauma. This article explores different therapeutic approaches and their effectiveness in helping survivors of abuse and violence.',
                'url' => 'https://fastercapital.co/i/Trauma--Unraveling-the-Psychological-Impact-of-Loss-and-Trauma--The-Role-of-Therapy-in-Trauma-Recovery.webp',
            ],
            (object) [
                'title' => 'Promoting Mental Wellness in the Workplace',
                'content' => 'Creating a supportive work environment that prioritizes mental wellness can significantly improve employee well-being and productivity. Learn how companies are implementing mental health initiatives.',
                'url' => 'https://www.brightermonday.co.ke/discover/wp-content/uploads/2023/05/mental-wellness-fb.png',
            ],
            (object) [
                'title' => 'Raising Awareness About Human Trafficking',
                'content' => 'Human trafficking is a pervasive issue that requires global attention. This article sheds light on the signs of trafficking and how individuals can help combat this crime.',
                'url' => 'https://today.ucsd.edu/news_uploads/kNOwMore-700.jpg',
            ],
            (object) [
                'title' => 'The Importance of Support Groups for Survivors',
                'content' => 'Support groups provide a safe space for survivors of abuse to share their experiences, find comfort, and receive emotional support. Discover how these groups are making a difference.',
                'url' => 'https://www.helpguide.org/wp-content/uploads/2023/02/Support-Groups.jpeg',
            ],
        ];

        foreach ($articles as $article) {
            $dataExists = Article::where('title', $article->title)->exists();

            if (!$dataExists) {
                $imageName = $this->downloadImage($article->url);

                Article::create([
                    'slug' => Str::slug($article->title),
                    'title' => $article->title,
                    'content' => $article->content,
                    'image' => $imageName
                ]);
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
