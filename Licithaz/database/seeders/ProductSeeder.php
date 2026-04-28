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
            'description' => 'Szabadon álló mikrohullámú sütő, 1250 W teljesítmény, nyomógombos vezérlés.',
            'extended_description' => 'A Samsung MS23K3513AK/EO mikrohullámú sütő egy praktikus és hatékony konyhai eszköz, amely megkönnyíti az ételek gyors melegítését és főzését. Ez a szabadon álló mikrohullámú sütő 1250 W teljesítménnyel rendelkezik, ami lehetővé teszi az ételek gyors és egyenletes melegítését. A vezérlés nyomógomb segítségével történik, így könnyen beállítható a kívánt teljesítményfokozat és időtartam.',
            'starter_bid' => 39990.00,
            'image_url' => 'https://image.alza.cz/products/SAMMW010/SAMMW010.jpg?width=800&height=800',
        ]);
        Product::factory()->create([
            'name' => 'Hütő - BOSCH KGV58VLEAS',
            'category' => 'electronics',
            'description' => 'Szabadon álló hűtőszekrény, E energiaosztály, 376 literes hűtőkapacitás, 124 literes fagyasztókapacitás.',
            'extended_description' => 'A Bosch KGV58VLEAS hűtőszekrény egy modern és energiatakarékos készülék, amely ideális választás a családok számára. Ez a hűtőszekrény E energiaosztályba tartozik, ami azt jelenti, hogy hatékonyan működik és alacsony energiafogyasztást biztosít. A 376 literes hűtőszekrény kapacitás elegendő helyet kínál az élelmiszerek tárolására, míg a 124 literes fagyasztó kapacitás lehetővé teszi a fagyasztott ételek kényelmes tárolását.',
            'starter_bid' => 249990.00,
            'image_url' => 'https://image.alza.cz/products/BOCHL172/BOCHL172.jpg?width=800&height=800',
        ]);
        Product::factory()->create([
            'name' => 'Apple iPhone 15 128GB fekete',
            'category' => 'Electronics',
            'description' => 'Okostelefon 6.1" Super Retina XDR kijelzővel, A16 Bionic chip, 48 MP kamera rendszer.',
            'extended_description' => 'Az Apple iPhone 15 egy modern okostelefon, amely rendkívül kifinomult technológiával rendelkezik. A 6.1 hüvelyk Super Retina XDR kijelzője nagyon részletes képeket jelenít meg, míg az A16 Bionic chip biztosítja a gyors és zökkenőmentes teljesítményt. A 48 MP kamera rendszer lehetővé teszi a minőségi fényképezést, míg a Face ID biztonságos bejelentkezést tesz lehetővé.',
            'starter_bid' => 389990.00,
            'image_url' => 'https://image.alza.cz/products/HRI045b1/HRI045b1.jpg?width=800&height=800',
        ]);

        Product::factory()->create([
            'name' => 'Samsung Galaxy Tab S9',
            'category' => 'Electronics',
            'description' => '11" AMOLED kijelző, Snapdragon 8 Gen 2, S Pen támogatás, 256GB tárhely.',
            'extended_description' => 'A Samsung Galaxy Tab S9 egy prémium kategóriás tablet, amely kiváló teljesítményt és lenyűgöző kijelzőt kínál. Az 11 hüvelykes AMOLED kijelző élénk színeket és mély feketéket biztosít, míg a Snapdragon 8 Gen 2 processzor gyors és hatékony működést garantál. Az S Pen támogatás lehetővé teszi a kreatív munkát és jegyzetelést, míg a 256GB tárhely elegendő helyet biztosít az alkalmazásoknak, fájloknak és médiának.',
            'starter_bid' => 329990.00,
            'image_url' => 'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_127814357?x=1800&y=1800&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=1800&ey=1800&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=1800&cdy=1800',
        ]);

        Product::factory()->create([
            'name' => 'Harry Potter és a Bölcsek Köve',
            'category' => 'Books',
            'description' => 'J. K. Rowling klasszikus fantasy regénye, keménykötéses kiadás.',
            'extended_description' => 'J. K. Rowling klasszikus fantasy regénye, keménykötéses kiadás.',
            'starter_bid' => 4990.00,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6n1FjUsoFf5JL4gjUn2S2UtCpvpJCJEqJhQ&s',
        ]);

        Product::factory()->create([
            'name' => 'A hobbit - J. R. R. Tolkien',
            'category' => 'Books',
            'description' => 'Fantasy regény Bilbó utazásáról, puhatáblás kiadás.',
            'extended_description' => 'J. R. R. Tolkien klasszikus fantasy regénye, puhatáblás kiadás.',
            'starter_bid' => 3990.00,
            'image_url' => 'https://lira.erbacdn.net/upload/M_28/rek1/776/1949776.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Nike Air Max 270',
            'category' => 'Clothing',
            'description' => 'Sportcipő légbetétes talppal, mindennapi használatra és sporthoz.',
            'extended_description' => 'A Nike Air Max 270 egy modern sportcipő, amely kiváló komfortot és teljesítményt kínál. A légbetétes talp biztosítja a kényelmes viseletet, míg a modern dizájn ideális a mindennapi használatra és sporthoz.',
            'starter_bid' => 54990.00,
            'image_url' => 'https://sportano.hu/img/986c30c27a3d26a3ee16c136f92f4ff5/6/6/666003558919_20-jpg/nike-air-max-270-ferfi-cipo-fekete-fekete-fekete-fekete-1687233.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Adidas Essentials Hoodie',
            'category' => 'Clothing',
            'description' => 'Uniszex kapucnis pulóver, pamut anyag, kényelmes viselet.',
            'extended_description' => 'A Adidas Essentials Hoodie egy kényelmes és stílusos pulóver, amely kiváló minőségben készül. A pamut anyag biztosítja a kényelmes viseletet, míg a modern dizájn ideális a mindennapi használatra.',
            'starter_bid' => 19990.00,
            'image_url' => 'https://i.sportisimo.com/products/images/2064/2064335/700x700/adidas-m-feelcozy-hoody_0.jpg',
        ]);

        Product::factory()->create([
            'name' => 'IKEA MALM Komód',
            'category' => 'House',
            'description' => 'Modern komód 6 fiókkal, fehér színben, hálószobába vagy nappaliba.',
            'extended_description' => 'A IKEA MALM komód egy modern és funkcionális bútor, amely kiváló tárolási lehetőségeket biztosít. A 6 fiók segítségével könnyedén rendezhetők az tárgyak, míg a fehér szín beilleszkedik bármely dekorációba.',
            'starter_bid' => 44990.00,
            'image_url' => 'https://www.ikea.com/hu/hu/images/products/malm-4-fiokos-szekreny-fekete-barna__0484876_pe621355_s5.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Philips Hue Starter Kit',
            'category' => 'House',
            'description' => 'Okos világítási csomag, állítható színű LED izzókkal.',
            'extended_description' => 'A Philips Hue Starter Kit egy okos világítási csomag, amely lehetővé teszi a színes és állítható világítást otthonában. A LED izzók különböző színekben és fényerősséggel állíthatók, így könnyedén megváltoztathatja a hangulatot és a stílust a helyiségben.',
            'starter_bid' => 59990.00,
            'image_url' => 'https://www.lampak.hu/kezdocsomag-philips-hue-starter-kit-white-3xe27-9w-2700k-kozponti-egyseg-img-p3081-fd-3.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Adidas UEFA Champions League Labda',
            'category' => 'Sports',
            'description' => 'Hivatalos meccslabda, prémium varrással.',
            'extended_description' => 'Az Adidas UEFA Champions League Labda egy hivatalos meccslabda, amely prémium varrással és minőségi anyagokból készült. Ez a labda ideális választás a focirajongók számára, akik szeretnék élvezni a játékot egy professzionális szintű labdával.',
            'starter_bid' => 12990.00,
            'image_url' => 'https://image.1ntersport.com/storage/products-new/4A/94/4A944CABC1D82E5A5704BD6731AF443FA4ca.1125x1125.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Kettler Fitness Kerékpár',
            'category' => 'Sports',
            'description' => 'Otthoni szobakerékpár LCD kijelzővel és állítható ellenállással.',
            'extended_description' => 'A Kettler Fitness Kerékpár egy otthoni szobakerékpár, amely ideális választás a fitnesz szerelmeseinek. Az LCD kijelző segítségével nyomon követheti az edzés adatait, míg az állítható ellenállás lehetővé teszi a különböző edzési szintek beállítását.',
            'starter_bid' => 89990.00,
            'image_url' => 'https://budapestkerekpar.hu/wp-content/uploads/2022/06/budapestkerekpar_kettlertraveller_01.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Toyota Corolla 1.8 Hybrid',
            'category' => 'Vehicles',
            'description' => 'Hibrid személyautó, alacsony fogyasztással és modern biztonsági rendszerekkel.',
            'extended_description' => 'A Toyota Corolla 1.8 Hybrid egy hibrid személyautó, amely alacsony fogyasztással és modern biztonsági rendszerekkel rendelkezik.',
            'starter_bid' => 10999000.00,
            'image_url' => 'https://static.stylemagazin.hu/medias/159296/_06a17a39f1cf4927aefa5b425f569f87.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Yamaha YZF-R3 Motor',
            'category' => 'Vehicles',
            'description' => 'Sportmotor 321cc motorral, könnyű kezelhetőség.',
            'extended_description' => 'A Yamaha YZF-R3 egy sportmotor, amely 321cc motorral rendelkezik és könnyű kezelhetőséget biztosít. Ez a motor ideális választás a kezdő és középhaladó motorosok számára, akik szeretnék élvezni a sportos vezetést.',
            'starter_bid' => 2299000.00,
            'image_url' => 'https://kocsi-media.hu/561713/yamaha-yzf-r3-771976_423714_28t.jpg',
        ]);

        Product::factory()->create([
            'name' => '14K Arany Gyűrű',
            'category' => 'Jewelry',
            'description' => 'Elegáns arany gyűrű minimalista dizájnnal.',
            'extended_description' => 'A 14K arany gyűrű egy elegáns és stílusos kiegészítő, amely kiváló minőségben készül. A minimalista dizájn ideális a mindennapi használatra.',
            'starter_bid' => 89990.00,
            'image_url' => 'https://www.jmaekszer.hu/kepek/nagy_kepek/arany/piros_augyuru_600x600(2).jpg',
        ]);

        Product::factory()->create([
            'name' => 'Swarovski Nyaklánc',
            'category' => 'Jewelry',
            'description' => 'Kristály díszítésű nyaklánc, ajándéknak is tökéletes.',
            'extended_description' => 'A Swarovski nyaklánc egy gyönyörű és elegáns kiegészítő, amely kristály díszítéssel rendelkezik. Ez a nyaklánc tökéletes ajándék lehet szeretteinek.',
            'starter_bid' => 34990.00,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSOfuMeKIWqYjsRiwOPhNBxDSLKrnwQ6NbwA&s',
        ]);

        Product::factory()->create([
            'name' => 'Sony WH-1000XM5 Fejhallgató',
            'category' => 'Electronics',
            'description' => 'Zajszűrős vezeték nélküli fejhallgató prémium hangzással.',
            'extended_description' => 'A Sony WH-1000XM5 egy zajszűrős vezeték nélküli fejhallgató, amely prémium hangzást és kényelmet biztosít. Ez a fejhallgató ideális választás a zene szerelmeseinek, akik szeretnék élvezni a kiváló hangminőséget és a zajszűrést.',
            'starter_bid' => 149990.00,
            'image_url' => 'https://img.jofogas.hu/hdimages/Sony_WH_1000XM5_fejhallgato_fekete__ujszeru_allapot__782202776881475.jpg',
        ]);

        Product::factory()->create([
            'name' => 'Canon EOS R10 Kamera',
            'category' => 'Electronics',
            'description' => 'Tükör nélküli fényképezőgép 24.2 MP szenzorral.',
            'extended_description' => 'A Canon EOS R10 egy tükör nélküli fényképezőgép, amely 24.2 MP szenzorral rendelkezik. Ez a kamera ideális választás a fotósok számára, akik szeretnék megörökíteni a pillanatokat kiváló minőségben.',
            'starter_bid' => 329990.00,
            'image_url' => 'https://www.rockbrookcamera.com/cdn/shop/articles/22-8-canon-r10-hero.jpg?v=1660580779',
        ]);

        Product::factory()->create([
            'name' => 'The North Face Kabát',
            'category' => 'Clothing',
            'description' => 'Téli kabát vízálló és szélálló anyagból.',
            'extended_description' => 'A The North Face Kabát egy téli kabát, amely vízálló és szélálló anyagból készül. Ez a kabát ideális választás a hideg időjárásban való aktivitásokhoz.',
            'starter_bid' => 79990.00,
            'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRapx1bgVtzPeLxVEMIWc0hmc-PS1pmNnRf1w&s',
        ]);

        Product::factory()->create([
            'name' => 'Gumicsónak Intex Explorer 300',
            'category' => 'Sports',
            'description' => '3 személyes gumicsónak evezőkkel és pumpával.',
            'extended_description' => 'A Gumicsónak Intex Explorer 300 egy 3 személyes gumicsónak, amely evezőkkel és pumpával rendelkezik. Ez a csónak ideális választás a tóparti vagy folyami tevékenységekhez.',
            'starter_bid' => 24990.00,
            'image_url' => 'https://img.jofogas.hu/620x620aspect/Intex_Challenger_400_felfujhato_gumicsonak__4_szemelyes_288252783740297.jpg',
        ]);
        //Product::factory(100)->create();
    }
}
