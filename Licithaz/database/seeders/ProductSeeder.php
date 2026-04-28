<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'Mikro - SAMSUNG MS23K3513AK/EO ',
            'category' => 'electronics',
            'description' => 'Mikrohullámú sütő - szabadon álló, 1250 W teljesítmény, vezérlés nyomógomb segítségével, 23 l belső űrtartalom, 6 teljesítményfokozat, 800W mikrohullám teljesítmény, 28,8 cm átmérőjű forgótányér, kiolvasztás, automata programok, balra nyíló ajtó, tartozék forgótányér, külső méretei 27,5 × 48,9 × 37,4 cm (ma × szé × mé), belső méretei 21,1 × 33 × 32,4 cm (ma × szé × mé)',
            'starter_bid' => 39990.00,
            'image_url' => 'https://image.alza.cz/products/SAMMW010/SAMMW010.jpg?width=800&height=800',
        ]);
        Product::factory()->create([
            'name' => 'Hütő - BOSCH KGV58VLEAS',
            'category' => 'electronics',
            'description' => 'Hűtőszekrény fagyasztóval - E energiaosztály, 376 l hűtőszekrény kapacitás, 124 l fagyasztó kapacitás, 4 polc, opcionálisan elhelyezhető pántok, kijelző és LED világítás, automatikus hűtő leolvasztás, LowFrost, méretei 191 × 70 × 77 cm (ma × szé × mé)',
            'starter_bid' => 249990.00,
            'image_url' => 'https://image.alza.cz/products/BOCHL172/BOCHL172.jpg?width=800&height=800',
        ]);
        Product::factory()->create([
            'name' => 'Apple iPhone 15 128GB fekete',
            'category' => 'Electronics',
            'description' => 'Okostelefon 6.1" Super Retina XDR kijelzővel, A16 Bionic chip, 48 MP kamera rendszer, Face ID, 5G támogatás.',
            'starter_bid' => 389990.00,
            'image_url' => 'https://image.alza.cz/products/HRI045b1/HRI045b1.jpg?width=800&height=800',
        ]);

        Product::factory()->create([
            'name' => 'Samsung Galaxy Tab S9',
            'category' => 'Electronics',
            'description' => '11" AMOLED kijelző, Snapdragon 8 Gen 2, S Pen támogatás, 256GB tárhely.',
            'starter_bid' => 329990.00,
            'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_127814357?x=1800&y=1800&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=1800&ey=1800&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=1800&cdy=1800',
        ]);

        Product::factory()->create([
            'name' => 'Harry Potter és a Bölcsek Köve',
            'category' => 'Books',
            'description' => 'J. K. Rowling klasszikus fantasy regénye, keménykötéses kiadás.',
            'starter_bid' => 4990.00,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6n1FjUsoFf5JL4gjUn2S2UtCpvpJCJEqJhQ&s',
        ]);

        Product::factory()->create([
            'name' => 'A hobbit - J. R. R. Tolkien',
            'category' => 'Books',
            'description' => 'Fantasy regény Bilbó utazásáról, puhatáblás kiadás.',
            'starter_bid' => 3990.00,
            'image_url' => 'https://lira.erbacdn.net/upload/M_28/rek1/776/1949776.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Nike Air Max 270',
            'category' => 'Clothing',
            'description' => 'Sportcipő légbetétes talppal, mindennapi használatra és sporthoz.',
            'starter_bid' => 54990.00,
            'image_url' => 'https://sportano.hu/img/986c30c27a3d26a3ee16c136f92f4ff5/6/6/666003558919_20-jpg/nike-air-max-270-ferfi-cipo-fekete-fekete-fekete-fekete-1687233.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Adidas Essentials Hoodie',
            'category' => 'Clothing',
            'description' => 'Uniszex kapucnis pulóver, pamut anyag, kényelmes viselet.',
            'starter_bid' => 19990.00,
            'image_url' => 'https://i.sportisimo.com/products/images/2064/2064335/700x700/adidas-m-feelcozy-hoody_0.jpg',
        ]);

        Product::factory()->create([
            'name' => 'IKEA MALM Komód',
            'category' => 'House',
            'description' => 'Modern komód 6 fiókkal, fehér színben, hálószobába vagy nappaliba.',
            'starter_bid' => 44990.00,
            'image_url' => 'https://www.ikea.com/hu/hu/images/products/malm-4-fiokos-szekreny-fekete-barna__0484876_pe621355_s5.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Philips Hue Starter Kit',
            'category' => 'House',
            'description' => 'Okos világítási csomag, állítható színű LED izzókkal.',
            'starter_bid' => 59990.00,
            'image_url' => 'https://www.lampak.hu/kezdocsomag-philips-hue-starter-kit-white-3xe27-9w-2700k-kozponti-egyseg-img-p3081-fd-3.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Adidas UEFA Champions League Labda',
            'category' => 'Sports',
            'description' => 'Hivatalos meccslabda, prémium varrással.',
            'starter_bid' => 12990.00,
            'image_url' => 'https://image.1ntersport.com/storage/products-new/4A/94/4A944CABC1D82E5A5704BD6731AF443FA4ca.1125x1125.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Kettler Fitness Kerékpár',
            'category' => 'Sports',
            'description' => 'Otthoni szobakerékpár LCD kijelzővel és állítható ellenállással.',
            'starter_bid' => 89990.00,
            'image_url' => 'https://example.com/bike.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Toyota Corolla 1.8 Hybrid',
            'category' => 'Vehicles',
            'description' => 'Hibrid személyautó, alacsony fogyasztással és modern biztonsági rendszerekkel.',
            'starter_bid' => 10999000.00,
            'image_url' => 'https://example.com/corolla.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Yamaha YZF-R3 Motor',
            'category' => 'Vehicles',
            'description' => 'Sportmotor 321cc motorral, könnyű kezelhetőség.',
            'starter_bid' => 2299000.00,
            'image_url' => 'https://example.com/yamaha.jpg',
        ]);

        Product::factory()->create([
            'name' => '14K Arany Gyűrű',
            'category' => 'Jewelry',
            'description' => 'Elegáns arany gyűrű minimalista dizájnnal.',
            'starter_bid' => 89990.00,
            'image_url' => 'https://example.com/ring.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Swarovski Nyaklánc',
            'category' => 'Jewelry',
            'description' => 'Kristály díszítésű nyaklánc, ajándéknak is tökéletes.',
            'starter_bid' => 34990.00,
            'image_url' => 'https://example.com/necklace.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Sony WH-1000XM5 Fejhallgató',
            'category' => 'Electronics',
            'description' => 'Zajszűrős vezeték nélküli fejhallgató prémium hangzással.',
            'starter_bid' => 149990.00,
            'image_url' => 'https://example.com/sony-headphones.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Canon EOS R10 Kamera',
            'category' => 'Electronics',
            'description' => 'Tükör nélküli fényképezőgép 24.2 MP szenzorral.',
            'starter_bid' => 329990.00,
            'image_url' => 'https://example.com/canon.jpg',
        ]);

        Product::factory()->create([
            'name' => 'The North Face Kabát',
            'category' => 'Clothing',
            'description' => 'Téli kabát vízálló és szélálló anyagból.',
            'starter_bid' => 79990.00,
            'image_url' => 'https://example.com/northface.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Gumicsónak Intex Explorer 300',
            'category' => 'Sports',
            'description' => '3 személyes gumicsónak evezőkkel és pumpával.',
            'starter_bid' => 24990.00,
            'image_url' => 'https://example.com/boat.jpg',
        ]);
        Product::factory(100)->create();
    }
}
