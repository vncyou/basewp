<?php
/**
 * Plugin Name: Dummy Data
 * Description: Create Post Demo
 * Version: 1.0.0
 * Author: TuanNDA
 * Author Uri: https://cyou.vn
 * Text Domain: dcs
 */

require_once(ABSPATH . 'wp-admin/includes/image.php');

class Dummy
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'adminMenu'));
    }

    public function adminMenu()
    {
        add_submenu_page('tools.php', 'Dummy Posts', 'Dummy Data', 'manage_options', 'dcs_dummy', array(
            $this,
            'adminLayout'
        ));
    }

    public function adminLayout()
    {
        if (isset($_POST['submit-post'])) {
            $catId = $_POST['cat_id'] ?: '';
            if ($catId > 0) {
                $this->insertPosts($catId);
            }
        }
    ?>
        <div class="wrap">
            <h2><?php _e('Dummy Posts', 'base') ?></h2>
            <form id="dcs_dummy_post" method="post">
                <?php wp_dropdown_categories(array(
                    'hide_empty' => 0,
                    'name' => 'cat_id',
                    'id' => 'categories',
                    'hierarchical' => true,
                    'show_option_none' => __('None'),
                )); ?>
                <input type="submit" value="Dummy Posts" name="submit-post" class="button button-primary"/>
            </form>
        </div>
    <?php
    }

    public function insertPosts($cat_id)
    {
        $images = [
            'photo-1532939624-3af1308db9a5.jpeg',
            'photo-1543076659-9380cdf10613.jpeg',
            'photo-1543339308-43e59d6b73a6.jpeg',
            'photo-1544025162-d76694265947.jpeg',
            'photo-1545093149-618ce3bcf49d.jpeg',
            'photo-1546069901-ba9599a7e63c.jpeg',
            'photo-1546554137-f86b9593a222.jpeg',
            'photo-1548940740-204726a19be3.jpeg',
            'photo-1555243896-c709bfa0b564.jpeg',
            'photo-1555939594-58d7cb561ad1.jpeg',
            'photo-1556040220-4096d522378d.jpeg',
            'photo-1557748362-4e95f0de4f6f.jpeg',
            'photo-1559054663-e8d23213f55c.jpeg',
            'photo-1559181567-c3190ca9959b.jpeg',
            'photo-1559598467-8be25b6dc34f.jpeg',
            'photo-1559742811-822873691df8.jpeg',
            'photo-1414235077428-338989a2e8c0.jpeg',
            'photo-1432139555190-58524dae6a55.jpeg',
            'photo-1454944338482-a69bb95894af.jpeg',
            'photo-1455619452474-d2be8b1e70cd.jpeg',
            'photo-1466637574441-749b8f19452f.jpeg',
            'photo-1470337458703-46ad1756a187.jpeg',
            'photo-1473093295043-cdd812d0e601.jpeg',
            'photo-1475090169767-40ed8d18f67d.jpeg',
            'photo-1476224203421-9ac39bcb3327.jpeg',
            'photo-1478144592103-25e218a04891.jpeg',
            'photo-1482049016688-2d3e1b311543.jpeg',
            'photo-1484300681262-5cca666b0954.jpeg',
            'photo-1484980972926-edee96e0960d.jpeg',
            'photo-1486328228599-85db4443971f.jpeg',
            'photo-1488477181946-6428a0291777.jpeg',
            'photo-1488900128323-21503983a07e.jpeg',
            'photo-1490818387583-1baba5e638af.jpeg',
            'photo-1493770348161-369560ae357d.jpeg',
            'photo-1494859802809-d069c3b71a8a.jpeg',
            'photo-1496116218417-1a781b1c416c.jpeg',
            'photo-1496412705862-e0088f16f791.jpeg',
            'photo-1499028344343-cd173ffc68a9.jpeg',
            'photo-1501959915551-4e8d30928317.jpeg',
            'photo-1504674900247-0877df9cc836.jpeg',
            'photo-1504754524776-8f4f37790ca0.jpeg',
            'photo-1505576633757-0ac1084af824.jpeg',
            'photo-1505935428862-770b6f24f629.jpeg',
            'photo-1506368249639-73a05d6f6488.jpeg',
            'photo-1509365465985-25d11c17e812.jpeg',
            'photo-1516211697506-8360dbcfe9a4.jpeg',
            'photo-1517433367423-c7e5b0f35086.jpeg',
            'photo-1520201163981-8cc95007dd2a.jpeg',
            'photo-1525351326368-efbb5cb6814d.jpeg',
            'photo-1525351484163-7529414344d8.jpeg',
            'photo-1526318896980-cf78c088247c.jpeg',
            'photo-1529042410759-befb1204b468.jpeg',
            'photo-1530554764233-e79e16c91d08.jpeg',
            'photo-1532980400857-e8d9d275d858.jpeg',
            'photo-1534766438357-2b270dbd1b40.jpeg',
            'photo-1534939561126-855b8675edd7.jpeg',
            'photo-1535007813616-79dc02ba4021.jpeg',
            'photo-1539136788836-5699e78bfc75.jpeg',
            'photo-1540189549336-e6e99c3679fe.jpeg',
            'photo-1541795795328-f073b763494e.jpeg',
            'photo-1563897539633-7374c276c212.jpeg',
            'photo-1564750497011-ead0ce4b9448.jpeg',
            'photo-1565299507177-b0ac66763828.jpeg',
            'photo-1565299624946-b28f40a0ae38.jpeg',
            'photo-1565958011703-44f9829ba187.jpeg',
            'photo-1567769541715-8c71fe49fd43.jpeg',
            'photo-1568093858174-0f391ea21c45.jpeg',
            'photo-1568376794508-ae52c6ab3929.jpeg',
            'photo-1568600891621-50f697b9a1c7.jpeg',
            'photo-1569718212165-3a8278d5f624.jpeg',
            'photo-1571997478779-2adcbbe9ab2f.jpeg',
            'photo-1574484184081-afea8a62f9c0.jpeg',
            'photo-1576021182211-9ea8dced3690.jpeg',
            'photo-1577234286642-fc512a5f8f11.jpeg',
            'photo-1577805947697-89e18249d767.jpeg',
            'photo-1579113800032-c38bd7635818.jpeg',
            'photo-1586439702132-55ce0da661dd.jpeg',
            'photo-1586511934875-5c5411eebf79.jpeg',
            'photo-1587324438673-56c78a866b15.jpeg',
            'photo-1587883012610-e3df17d41270.jpeg',
            'photo-1590005354167-6da97870c757.jpeg',
            'photo-1592417817098-8fd3d9eb14a5.jpeg',
            'photo-1593854823220-49d01bebbfdc.jpeg',
            'photo-1594212699903-ec8a3eca50f5.jpeg',
            'photo-1600335895229-6e75511892c8.jpeg',
            'photo-1601004890684-d8cbf643f5f2.jpeg',
            'photo-1601314002592-b8734bca6604.jpeg',
            'photo-1601379760883-1bb497c558f0.jpeg',
            'photo-1603105037880-880cd4edfb0d.jpeg',
            'photo-1603408208671-a37faed58a7d.jpeg',
            'photo-1604152135912-04a022e23696.jpeg',
            'photo-1606066889831-35faf6fa6ff6.jpeg',
            'photo-1606787366850-de6330128bfc.jpeg',
            'photo-1607013251379-e6eecfffe234.jpeg',
            'photo-1609951651467-713256d1a3be.jpeg',
            'photo-1609951651556-5334e2706168.jpeg',
            'photo-1610440042657-612c34d95e9f.jpeg',
            'photo-1612240498936-65f5101365d2.jpeg',
            'photo-1614707267537-b85aaf00c4b7.jpeg',
            'photo-1617884157905-b66741c4a445.jpeg',
            'photo-1624564380926-bdb551ff0d43.jpeg',
            'photo-1628689469838-524a4a973b8e.jpeg',
        ];

        $posts = [
            "B??ng s???y qu???n ??o mang l???i nhi???u c??ng d???ng h???u ??ch, b???n ???? nghe ?????n ch??a?",
            "5 tr???i nghi???m ch??m s??c s???c kh???e ??? Bali, t??? li???u ph??p ??nh s??ng ?????n h??t th???.",
            "Ngh??? s?? Vpop ??ang th??? hi???n m???i quan t??m c???a m??nh v???i m??i tr?????ng qua s???n ph???m ??m nh???c",
            "Th??? gi???i ???? l??m g?? ????? t???n d???ng nh???ng chi???c b??nh m?? th???a, g??p ph???n gi???m thi???u l??ng ph?? th???c ph???m",
            "Anh b??o ?????ng ????? khi ????n nh???n m???c nhi???t k??? l???c.",
            "C??ch ???n ????? t???n d???ng nh???ng b??ng hoa c??ng ????? s???n xu???t h????ng",
            "T??i s??? d???ng tab nh??m tr??n nh???ng lon n?????c ng???t n???p gi???t ????? ??an t??i h??ng hi???u gi?? h??n 600$",
            "Ng?????i ph??? n??? bi???n ph??? th???i t??? c??c c??ng tr?????ng th??nh ????? n???i th???t cao c???p gi?? h??ng ngh??n ???? la",
            "Ch??? t???o c?? robot l??m nhi???m v??? thu gom h???t vi nh???a ngo??i ?????i d????ng",
            "Vitamin D t??? ??nh n???ng m???t tr???i c?? th??? gi??p ng??n ng???a ch???ng m???t tr?? nh??? v?? ch???ng l???i c??c b???nh kh??c.",
            "V?? sao n??i g??? xo??i l?? m???t nguy??n li???u h???u ??ch?",
            "14 lo??i thu???c B??? C?? voi ??ang c?? nguy c?? tuy???t ch???ng - Ph???n 2",
            "H??nh vi \"ph?? ho???i\" c??y b???c h?? m??o l?? c??ch c??c \"boss\" ??u???i mu???i?",
            "Vitamin D t??? ??nh n???ng m???t tr???i c?? th??? gi??p ng??n ng???a ch???ng m???t tr?? nh??? v?? ch???ng l???i c??c b???nh kh??c.",
            "Plastitar ??? h???n h???p tr???n gi???a h???c ??n v?? vi nh???a ??ang tr??? th??nh m???i ??e d???a m???i cho s??? s???ng ngo??i ?????i d????ng",
            "S??ng t???o h???p gi??? nhi???t ?????ng th???c ph???m t??? v???t li???u x??y d???ng d?? th???a",
            "Bi???n ?????i kh?? h???u ??ang ???nh h?????ng l??n c??? nh???ng chi???c pizza",
            "K-drama Why Her? Seo Hyun-jin v??o vai m???t lu???t s?? ?????c ??c.",
            "Kh?? h???u n??ng l??n l?? nguy??n nh??n khi???n s??? ng?????i g???p ch???ng m???t ng??? gia t??ng",
            "Kh??ng ch??? l??u tr??? carbon, r???ng c??n l??m ???????c nhi???u h??n th???",
            "Meta chi 27 tri???u USD ????? ?????m b???o an ninh cho Mark Zuckerberg trong n??m 2021",
            "M???t c?? quan ch??nh ph??? Hoa K??? ???? v?? t??nh gi???t nh???m g???n 3,000 ?????ng v???t c???n ???????c b???o v??? v??o n??m 2021",
            "Menu t???i c??c nh?? h??ng nay ph???i th???ng k?? l?????ng calo cho m???i m??n",
            "Th??? h??? Z c???a Trung Qu???c mu???n c??c th????ng hi???u 'Trung Qu???c sang tr???ng' ch??? kh??ng ph???i c??c th????ng hi???u n?????c ngo??i.",
            "T???ng th???ng M??? Joe Biden t??? ch???c ti???c c?????i cho ch??u g??i t???i Nh?? Tr???ng",
            "Khoa h???c ??ang nghi??n c???u v??? c??ch n???m ???tr?? chuy???n???",
            "Th??? h??? Gen Z thay ?????i th??i quen mua s???m th???i trang v?? lo l???ng v??? bi???n ?????i kh?? h???u.",
            "Tr??nh xa m???ng x?? h???i trong h??n 4 n??m qua gi??p t??i h???nh ph??c h??n",
            "Cu???n s??? ghi ch??p qu?? tr??nh ti???n ho?? b??? m???t c???a Charles Darwin tr??? l???i th?? vi???n Cambridge sau hai th???p k??? bi???n m???t",
            "Giun tr??? th??nh lo??i x??m l???n, g??y h???i cho nh???ng lo???i c??n tr??ng kh??c ??? B???c M???",
            "5 lo???i th???c ph???m gi??u prebiotic s???n c?? trong b???p c???a b???n",
            "Th??nh ?????a c???a ng?????i Inca - Machu Picchu b??? g???i nh???m t??n trong h??n 100 n??m",
            "H??nh tr??nh ????????t ch??n??? l??n ?????t M??? c???a c??y hoa anh ????o Nh???t B???n",
            "B???n n??n ??n lo???i tr??i c??y n??y 2 l???n m???i tu???n ????? gi???m nguy c?? m???c b???nh tim m???ch",
            "C??ch c??c l???p h???c tr???c tuy???n thay ?????i n??o b??? c???a tr??? em, l??m x??i m??n kh??? n??ng ph???c h???i c???a tr??? v?? khi???n m???t s??? tr??? ki???t s???c ho???c ch??n n???n",
            "T???i sao ??nh s??ng t??? nhi??n l???i t???t cho s??? ph??t tri???n c???a tr??? em",
            "G???ch x??y nh?? t??i ch??? t??? r??c th???i nh???a v?? c??t, c???ng g???p 5 l???n b?? t??ng",
            "5 nguy??n t???c ????ng nh??? ????? ch?? r??? xu???t hi???n n???i b???t trong ng??y c?????i",
            "B???i M???t Tr??ng do Neil Armstrong thu th???p chu???n b??? ???????c ????a ra b??n ?????u gi??",
            "Ngu???n g???c c???a bu???i ti???c ?????c th??n d??nh cho c?? d??u - The Bridal Shower",
            "Top 5 du thuy???n l???n nh???t t???i tri???n l??m du thuy???n h??ng ?????u th??? gi???i Palm Beach",
            "?? nhi???m kh??ng kh?? l??m t??ng kh??? n??ng tr???m c???m ??? thanh thi???u ni??n",
            "???????ng h???u c?? t??? c??y th??a c?? thu???n chay? Li???u n?? c?? t???t h??n nh???ng lo???i ???????ng kh??c?",
            "5 ??i???u ????ng suy ngh?? ????? xem n??ng ???? s???n s??ng l???y ch???ng ch??a?",
            "V?? sao xu h?????ng ghosting gi???a nh?? tuy???n d???ng v?? nh??n vi??n ng??y c??ng ph??? bi???n?",
            "Ch?? ch?? ng??y n??o c??ng ra bi???n ng???i ?????i ng?????i ch??? s??? kh??ng bao gi??? tr??? v???",
            "N??? ngh??? s?? b???t t??? h??a v??? ?????p c???a thi??n nhi??n qua nh???ng b???c ph?? ??i??u",
            "G???ch l??t n???n t??? mu???i than (black carbon) trong kh??ng kh?? ?? nhi???m",
            "B??ng n??? xu h?????ng s??? d???ng ????? ???qua tay??? ??? qu???n ??o secondhand.",
            "T??m t???t Stranger Things m??a 4: M???i th??? t??? Eleven",
            "Asus c??ng b??? m??n h??nh ch??i game Nvidia G-Sync 500Hz ?????u ti??n tr??n th??? gi???i",
            "Nh???ng s??? th???t c?? th??? b???n ch??a bi???t v??? lo??i voi",
            "T???i sao b??c s?? khuy??n n??n ??n 30 lo???i th???c v???t kh??c nhau m???i tu???n ????? gi??? cho h??? vi sinh v???t ti??u h??a ??? tr???ng th??i t???t",
            "T??? l???nh b???ng ?????t s??t kh??ng c???n d??ng ??i???n cho ng?????i d??n ngh??o ??? ???n ?????",
            "S??? c??? ti???n ??i???n t??? c?? g??y ra m???i ??e d???a cho h??? th???ng t??i ch??nh kh??ng?",
            "20 ng?????i n???i ti???ng d?????ng nh?? kh??ng gi?? ??i k??? t??? n??m 2000",
            "C??c lo???i nh???a th??ng th?????ng th???i ra h??ng ngh??n t??? h???t nano khi ti???p x??c v???i n?????c n??ng",
            "H??m l?????ng dinh d?????ng trong tr??i c??y v?? rau c??? ??ang gi???m d???n",
            "Bao b?? mini-sized v?? m???u th??? c???a m??? ph???m l??m ?????p: k??? ph?? ho???i m??i tr?????ng th???m l???ng ch??ng ta ???? v?? t??nh b??? qua",
            "Bi???n ch???t th???i l???ng ?????c h???i t??? ho???t ?????ng khai th??c m??? th??nh m??u v???",
            "Ng?????i cha Trung Qu???c y??u c???u con g??i 11 tu???i ????o c??? sen gi???a tr???i n???ng n??ng gay g???t ????? d???y con gi?? tr??? gi??o d???c",
            "???c x?? c??? kh???ng l??? - bi???u t?????ng c???a c??c b??i bi???n bang Florida - ??ang c?? nguy c?? tuy???t ch???ng",
            "T???i sao m???i ng?????i n??n quan t??m ?????n m???t ??a d???ng sinh h???c",
            "Ho??? s?? Motoo Abiko - Ng?????i c???ng s??? c???a cha ????? ???Doraemon??? qua ?????i",
            "Lo??i hoa c?? th??? t??? l??m m???t ng???t ng??o h??n khi nghe ti???ng ong vo ve ?????n g???n",
            "C?? ph?? v?? l???i ??ch s???c kh???e tim m???ch: u???ng 2 ?????n 3 t??ch m???i ng??y gi??p b???n s???ng l??u h??n",
            "B??nh Oreos c?? thu???n chay kh??ng?",
            "????? n???i th???t l??m t??? l?? c??y, v??? tr??i c??y",
            "Grid - B??? phim khoa h???c vi???n t?????ng c???a Disney, kh???i ?????u t???t nh??ng bi???n th??nh m???t m??? h???n ?????n du h??nh th???i gian kh??c c???a H??n Qu???c",
            "Twitter ch???p nh???n l???i ????? ngh??? ban ?????u tr??? gi?? 43 t??? ???? la c???a Musk",
            "Leicester k??? ni???m Ng??y Tr??i ?????t v???i qu??? ?????a c???u kh???ng l??? l??m b???ng r??c th???i thu gom t??? c??ng vi??n th??nh ph???",
            "M??y th??m hi???m c???a NASA ghi h??nh nh???t th???c tr??n sao H???a",
            "5 th???n t?????ng K-pop ???????c m???nh danh l?? 'v?? kh?? b?? m???t'- ai ???? n???i ti???ng ngay c??? tr?????c khi h??? ra m???t?",
            "Can thi???p kh?? h???u b???ng geo-engineering l??m t??ng nguy c?? m???c b???nh s???t r??t",
            "B???c tranh 400 tu???i c?? gi?? h??ng tri???u USD b???t ng??? ???????c t??m th???y trong nh?? kho",
            "M??ng b???c th???c ph???m ??n ???????c t??? tinh b???t s???n c???a nh??m sinh vi??n ?????i h???c B??ch khoa, TP.HCM",
            "IKEA s??? mua l???i ????? n???i th???t c?? t??? b???n",
            "Breathaboard ??? v???t li???u xanh thay th??? cho t?????ng v??ch th???ch cao",
            "T??? n??m 2026, Vi???t Nam s??? x??? ph???t nh???ng nh?? b??n l??? cung c???p t??i nylon d??ng m???t l???n cho kh??ch h??ng",
            "Ng?????i H??n Qu???c s??? s???m ???????c \"tr??? ra\" m???t n??m tu???i trong th???i gian t???i?",
            "V????ng qu???c Anh: ????? xu???t cho ph??p xem tv khi ??ang s??? d???ng xe t??? l??i tr??n cao t???c",
            "Hoa K??? ch???p thu???n ch??n th??? b?? r???ng tr??n th???o nguy??n Montana trong c??n b??o d?? lu???n",
            "Th???c v???t ????ng vai tr?? quan tr???ng trong vi???c ph??t tri???n c??c ph????ng ph??p ??i???u tr??? ung th?? trong t????ng lai",
            "Ch??nh ph??? M??? ph???i tr??? h??ng tri???u USD ????? b???o d?????ng du thuy???n c???a c??c t??? ph?? Nga b??? tr???ng ph???t",
            "Bi???n h???p b??nh k???o th??nh t??c ph???m ngh??? thu???t",
            "Nh???ng khu r???ng ?????u ti??n",
            "New York: M???t s??? ng?????i d??n ki???m h??ng ch???c ngh??n USD nh??? b??o c??o l??i xe vi ph???m",
            "Sinh vi??n l??m gi???y t??? th??n c??y chu???i",
            "Sao H???i V????ng tr???i qua c??c ?????t thay ?????i nhi???t b???t th?????ng ch??a ???????c l?? gi???i",
            "3 c??ng th???c l??m m???t n??? gi??p se kh??t l??? ch??n l??ng t???i nh??",
            "H???c 9 chi??u l??m ?????p t??? c??c ng??i sao ????nh ????m th??? gi???i ????? nhan s???c th??ng h???ng",
            "Th??m m???t th??nh ph???n c??? k???t th??n v???i retinol l?? nh??n ????i hi???u qu??? \"ch???ng gi??\" cho c??c ch??? em",
            "5 ki???u gi??y c??ng s??? d??? ph???i ????? nh???t, n??n s???m h???t ????? m???c ?????p m???i ng??y",
            "B??i kem ch???ng n???ng v?? ??eo kh???u trang c??ng l??c d??? s??? g??y m???n v?? b?? da, mu???n kh???c ph???c t??nh tr???ng n??y ch??? c???n l??u ?? nh???ng ??i???u sau",
            "6 chi??u l??n ????? gi??p t??ng ??i???m sang ch???nh m?? kh??ng t???n k??m ti???n b???c",
            "3 bi???n ph??p kh???c ph???c hi???u qu??? r???ng t??c sau sinh",
            "Mu???n s??? h???u v??? l???ch s??? khi ??i ??n c?????i th?? ????y l?? 3 l??u ?? ch??? em n??n nh???",
            "4 ki???u ch??n v??y l??m n??n phong c??ch sang tr???ng c???a ph??? n??? Ph??p",
            "3 m??u t??c nhu???m s??ng b???ng t??ng da, ch??? em nh???t ?????nh ph???i th??? trong n??m 2022 n??y",
            "Gi???m t??o, \"?????ng minh\" l??m ?????p t??? nhi??n cho da d???u v?? t??c x???n m??u",
            "Ngo??i kem ch???ng n???ng, n??ng 30+ c???n th???c hi???n th??m 3 b?????c n??y ????? ng??n ng???a l??o h??a da",
            "2 sai l???m khi b??i kem d?????ng khi???n cho l??n da m??i kh??ng ?????p l??n ???????c",
            "3 c??ch massage gi??p gi???m r???ng t??c, k??ch th??ch t??c m???c",
            "Tips ch???n ????? t??n d??ng, s??ng da cho c?? n??ng da ng??m ??en",
        ];

        $content = '<p>B??? C?? voi l?? m???t b??? c??c lo??i ?????ng v???t c?? v?? s???ng d?????i n?????c bao g???m c?? voi, c?? heo, c?? heo chu???t, c?? nh?? t??ng v?? k??? l??n bi???n. D???a v??o ?????c ??i???m sinh h???c m?? ch??ng l???i ???????c chia th??nh hai ph??n b??? l?? C?? voi t???m s???ng h??m (Mysticeti) v?? C?? voi c?? r??ng (Odontoceti). Cho d?? ??? ph??n b??? n??o, nh???ng lo??i ?????ng v???t n??y ?????u ??ang ph???i ?????i m???t v???i nguy c?? tuy???t ch???ng theo nh???ng c??ch kh??c nhau.</p>';
        $content .= '<p>Theo danh s??ch c???a Li??n minh B???o t???n Thi??n nhi??n Qu???c t???, c?? 14 trong s??? 89 lo??i thu???c b??? c?? voi c??n t???n t???i hi???n nay ??ang ??? t??nh tr???ng nguy c???p ho???c c???c k??? nguy c???p. C??? th??? bao g???m 5 lo??i c?? voi, 7 lo??i c?? heo v?? 2 lo??i c?? heo chu???t.</p>';
        $content .= '<h2>A1 - C?? voi tr??n B???c ?????i T??y D????ng ??? C???c k?? nguy c???p</h2>';
        $content .= '<p>V?? c?? h??m l?????ng ch???t b??o cao v?? d??? b???t g???p, c?? voi tr??n B???c ?????i T??y D????ng l?? ?????i t?????ng s??n b???t ch??? y???u nh???t v??o th??? k??? 18 v?? 19. T??n ti???ng anh c???a lo??i c?? voi n??y l?? North Atlantic ???Right??? Whale. Ch??? ???Right??? xu???t ph??t t??? t?? t?????ng: ch??ng l?? lo??i ???ph?? h???p??? ????? s??n b???t do b??i g???n b??? v?? d??? d??ng n???i l??n m???t n?????c sau khi b??? gi???t.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-1.jpeg"/>';
        $content .= '<h3>A1-1 - C?? heo Baiji ??? C?? th??? ???? tuy???t ch???ng</h3>';
        $content .= '<p>Ng??y nay, t???ng s??? l?????ng c?? th??? c?? voi tr??n c??n t???n t???i ch??? kho???ng 500, v???i 400 ??? ph??a t??y b???c ?????i T??y D????ng v?? ??t h??n 100 ??? khu v???c ph??a ????ng B???c ?????i T??y D????ng.</p>';
        $content .= '<p>C?? heo Baiji, hay C?? heo S??ng D????ng T???, hi???m g???p ?????n m???c ch??ng ???????c coi l?? ???? g???n nh?? ho??n to??n tuy???t ch???ng. N??m 2006, c??c nh?? khoa h???c ch??nh th???c tuy??n b??? s??? tuy???t ch??ng c???a c?? heo Baiji, m???c d?? sau ???? m???t ng?????i d??n ?????a ph????ng l???i cho r???ng ???? nh??n th???y ch??ng v??o n??m 2016. N???u s??? th???t ????ng nh?? tuy??n b??? c???a c??c nh?? khoa h???c, c?? heo Baiji s??? l?? lo??i c?? heo ?????u ti??n tuy???t ch???ng v?? ch???u t??c ?????ng ph??a t??? con ng?????i.</p>';
        $content .= '<p>Baiji l?? lo??i ?????c h???u c???a s??ng D????ng T???, ???????c ng?????i d??n k??nh tr???ng g???i v???i danh x??ng ???n??? th???n s??ng???. Tuy nhi??n, do ho???t ?????ng ????nh b???t khi???n ngu???n th???c ??n c???a c?? heo Baiji b??? c???n ki???t, ?????ng th???i ho???t ?????ng x??? th???i c??ng nghi???p l??m ?? nhi???m m??i tr?????ng s???ng, ch??ng ???? g???n nh?? ho??n to??n bi???n m???t t??? n??m 2002. V?? s??? ki???n ng?????i d??n cho r???ng ???? nh??n th???y ch??ng n??m 2016, c??c nh?? khoa h???c l???i m???t l???n n???a d???y l??n hi v???ng v?? chuy???n ch??ng t??? tr???ng th??i ???? tuy???t ch???ng th??nh c???c k?? nguy c???p.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-2.jpeg"/>';
        $content .= '<h3>A1-2L???ch s??? c???a li???u ph??p h????ng th??m</h3>';
        $content .= '<p>T??? 2.400 n??m tr?????c, ???cha ????? c???a ng??nh y h???c??? ???? hi???u ???????c s???c m???nh c???a ch???t th??m trong vi???c ph???c h???i s???c kh???e c???a m???t ng?????i. Hippocrates n??i: ???Vi???c ch???a b???nh b???t ?????u b???ng vi???c t???m n?????c th??m v?? m??t-xa h??ng ng??y???. </p>';
        $content .= '<p>M???t trong nh???ng l???i ??ch l???n nh???t c???a qu??? b??ng s???y l?? ch??ng s???y kh?? hi???u qu??? h??n nhi???u so v???i c??c t???m s???y v?? m??y s???y th??ng th?????ng. Nh???ng qu??? b??ng n??y s??? l??m kh?? nhanh h??n t???i 40% nh??? v??o vi???c ch??ng h???p th??? ????? ???m sau khi gi???t. T??? ???? gi??p ti???t ki???m ???????c nhi???u n??ng l?????ng h??n.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-3.jpeg"/>';
        $content .= '<h3>A1-3 - Ti???t ki???m th???i gian gi???t s???y</h3>';
        $content .= '<p>???N?? c?? nhi???u ???nh h?????ng ?????n ho???t ?????ng b??nh th?????ng c???a c?? th???. V?? d???, g???n ????y ch??ng t??i ???? ch??? ra r???ng c??ng m???t lo???i thi???u h???t nghi??m tr???ng l??m t??ng nguy c?? sa s??t tr?? tu??? c??ng c?? li??n quan ?????n nguy c?? vi??m nhi???m m???c ????? th???p v?? b???nh tim l???n h??n???.</p>';
        $content .= '<p>C?? n??i, nghi??n c???u c???a Hypponen, c??ng tr??nh l???n nh???t t??? tr?????c ?????n nay, v???i h??n 300.000 ng?????i tham gia, ???? ???????c truy???n c???m h???ng, b???i v?? ???t??? l??u ng?????i ta ???? nghi ng??? c??c th??? th??? vitamin D l??m trung gian cho c??c t??c ?????ng c???a hormone ho???t ?????ng c?? trong n??o ng?????i, v?? k???t qu??? l?? n?? c?? th??? c?? nh???ng t??c ?????ng ?????i v???i s??? ph??t tri???n c???a c??c b???nh v??? nh???n th???c th???n kinh nh?? ch???ng sa s??t tr?? tu??????.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-4.jpeg"/>';
        $content .= '<h2>A2 - ??? bia b???ng b??nh m?? th???a ??? London, Anh</h2>';
        $content .= '<p>Th??? nh???t, s??? hi???n di???n c???a c??c th??? th??? vitamin D ??? v??ng d?????i ?????i cho th???y r???ng vitamin D ho???t ?????ng s??? th??c ?????y s??? ph??t tri???n v?? tr?????ng th??nh c???a c??c t??? b??o th???n kinh - c??c ch???t d???n truy???n th??ng tin trong n??o.</p>';
        $content .= '<p>Th??? hai, vitamin D ho???t t??nh c?? li??n quan ?????n vi???c gi???m ????ng m??u v?? ??i???u ch???nh h??? th???ng ???nh h?????ng ?????n huy???t ??p - gi??p b???o v??? ch???ng l???i ?????t qu??? , c?? th??? l?? ch???t x??c t??c cho ch???ng sa s??t tr?? tu???.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-5.jpeg"/>';
        $content .= '<h3>A2 - 1 - Th??nh ph??? Rotterdam d??ng b??nh m?? b??? ??i ????? t??i t???o th??nh n??ng l?????ng</h3>';
        $content .= '<p>Hypponen n??i r???ng ch??? ????? ??n u???ng l?? m???t ngu???n cung c???p vitamin D ngh??o n??n; Trong khi m???t s??? th???c ph???m nh?? c?? d???u, tr???ng v?? s???a c?? ch???a m???t s??? vitamin D, th???c t??? l?? kh??ng th??? c?? ????? t??? th???c ph???m, tr??? khi ch??? ????? ??n u???ng c??ng bao g???m c??c s???n ph???m th???c ph???m ???????c t??ng c?????ng vitamin D.</p>';
        $content .= '<p>C?? n??i r???ng kh??ng ph???i l??c n??o c??ng c???n m???t b??i ki???m tra. Nh???ng ng?????i c?? l???i s???ng n??ng ?????ng v?? th?????ng xuy??n ra ngo??i tr???i trong nh???ng gi??? c?? ??nh s??ng m???t tr???i, c?? kh??? n??ng c?? ????? l?????ng vitamin D trong n??m. Trong nh???ng th??ng m??a ????ng ??t n???ng, b??? sung vitamin D ????n gi???n kh??ng c???n k?? ????n c?? th??? gi??p duy tr?? m???c ????? ????.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-6.jpeg"/>';
        $content .= '<h3>A2 - 2 - Bi???n b??nh m?? th???a tr??? l???i th??nh b???t ????? ti???p t???c s??? d???ng ??? Ph??p</h3>';
        $content .= '<p>???Ch??ng t??i th???y t??c ?????ng m???nh nh???t ?????n nguy c?? sa s??t tr?? tu??? v???i nh???ng ng?????i tham gia c?? n???ng ????? r???t th???p (d?????i 25nmol / L). Nguy c?? t??ng nh??? ?????i v???i nh???ng ng?????i ??? trong kho???ng 25-50 nmol / L, nh??ng h???u h???t, theo m?? h??nh c???a ch??ng t??i, d?????ng nh?? nh???ng ng?????i ???? ?????t ???????c m???c t??? 50 nmol / L tr??? l??n g???n nh?? kh??ng c?? nguy c?????.</p>';
        $content .= '<p>N?? cho th???y r???ng ng??n ng???a s??? thi???u h???t vitamin D trong d??n s??? s??? gi??p gi???m nguy c?? sa s??t tr?? tu???, c??ng nh?? c??c nguy c?? c?? th??? tr??nh ???????c c???a nhi???u b???nh kh??c, c?? n??i.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-7.jpeg"/>';
        $content .= '<h3>A2 - 3 - Nghi??n c???u c???a Hypponen c?? ?? ngh??a nh?? th??? n??o?</h3>';
        $content .= '<p>NHS cho bi???t b???n kh??ng th??? d??ng qu?? li???u vitamin D khi ti???p x??c v???i ??nh n???ng m???t tr???i. Nh??ng b???n c?? th??? b??? ch??y n???ng. V?? v???y, h??y che ch???n v?? b???o v??? da b???ng kem ch???ng n???ng c?? ch??? s??? SPF cao. May m???n thay, trong su???t m??a h??, h???u h???t m???i ng?????i ch??? c???n ??? d?????i ??nh n???ng ch??i chang v??i ph??t m???i ng??y ????? c?? ????? vitamin D.</p>';
        $content .= '<p>Nh??ng ch???t dinh d?????ng nh??? b?? quan tr???ng n??y ???? c?? l???ch s??? l??u ?????i ngay c??? tr?????c khi Windaus gi???i th??ch. C??i x????ng, b???nh x????ng do thi???u vitamin D, ???? ???????c ghi nh???n h??n 200 n??m v?? l???n ?????u ti??n ???????c m?? t??? trong c??c t??i li???u y khoa v??o n??m 1650.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-8.jpeg"/>';
        $content .= '<h3>A2 - 4 - M??i h????ng ???nh h?????ng nh?? th??? n??o ?????n h???nh ph??c?</h3>';
        $content .= '<p>Trong nh???ng n??m g???n ????y, lo???i vitamin tan trong ch???t b??o n??y ???????c qu???ng c??o l?? t???t cho ch??ng ta theo nhi???u c??ch, t??? b???o v??? s???c kh???e c???a x????ng ?????n t??ng c?????ng kh??? n??ng mi???n d???ch. C??c nghi??n c???u trong ph??ng th?? nghi???m cho th???y vitamin D th???m ch?? c?? th??? l??m gi???m s??? ph??t tri???n c???a t??? b??o ung th??, gi??p ki???m so??t nhi???m tr??ng v?? gi???m vi??m.</p>';
        $content .= '<p>Sau khi x?? nh??? s??? b??nh m?? c??, h??? s??? ????a ch??ng qua m??y nghi???n th??nh v???n nh??? v?? d??ng s??? v???n n??y thay th??? 20% l?????ng b???t m?? c???n s??? d???ng trong m???i m??? b??nh. B??nh th??nh ph???m khi ra l?? m???c d?? c?? m??u ?????m h??n nh??ng h????ng v??? ho??n to??n kh??ng b??? ???nh h?????ng.</p>';
        $content .= '<caption class="wp-caption aligncenter"><img src="https://basewp.lndo.site/demo/anh-9.jpeg"/><figcaption class="wp-caption-text">V?? sao n??i g??? xo??i l?? m???t nguy??n li???u h???u ??ch?</figcaption></caption>';
        $content .= '<p>Nh???c ?????n b??nh m?? kh??ng th??? b??? qua Ph??p. Ng?????i d??n Ph??p s??? d???ng b??nh m?? nh?? m???t m??n ??n ch??nh h??ng ng??y v?? ch??? ??a chu???ng b??nh m?? t????i, kh??ng qua ????ng g??i b???o qu???n. ???? l?? l?? do t???i sao c?? ?????n h??n 150,000 t???n b??nh m?? b??? b??? ??i ??? Ph??p m???i n??m.</p>';
        $content .= '<p>Guillaume Devinat, ch??? c???a m???t trong s??? h??n 100 ti???m b??nh ??? Ph??p ??ang s??? d???ng lo???i m??y n??y, chia s??? anh c??ng nh???ng ng?????i th??? t???i c???a h??ng ??ang th??? m???t c??ng th???c b??nh m?? baguette m???i c?? ch???a th??nh ph???n ???b???t??? nghi???n t??? nh???ng chi???c b??nh m?? th???a ch??a b??n ???????c ng??y h??m tr?????c.</p>';
        $content .= '<p>Guillaume Devinat cho bi???t th??m n???u ???????c l??m kh?? ????ng c??ch, v???n b??nh m?? c?? th??? b???o qu???n v??i th??ng v?? v?? ???????c nhi???u kh??ch h??ng ???ng h???, anh c??ng ??ang th??? nghi???m th??m nhi???u c??ng th???c kh??c s??? d???ng th??nh ph???n ???v???n b??nh m?? gi???i c???u???.</p>';
        $content .= '<h4>A3 - L???i ??ch c???a ch??ng ?????i v???i tinh th???n v?? th??? ch???t</h4>';
        $content .= '<p>Cheung cho bi???t c??c lo???i tinh d???u mang l???i nhi???u l???i ??ch cho kh??ch h??ng c???a m??nh: m???t s??? c?? l??n da tr??ng tr??? h??n v?? t??c m???c r?? r???t, nh???ng ng?????i kh??c ???? s??? d???ng tinh d???u ????? xoa d???u c??n ??au kinh nguy???t ?????ng th???i gi???m thi???u v???t r???n da. Nhi???u ng?????i trong s??? h??? s??? d???ng tinh d???u t???i ch???, th??ng qua kem d?????ng da ho???c gel.</p>';
        $content .= '<p>Trong qu?? tr??nh th???c h??nh v?? nghi??n c???u c???a m??nh, Ti???n s?? Theresa Lai Tze-kwan c??ng ???? ch???ng ki???n ??????c??ch li???u ph??p h????ng th??m c?? th??? gi??p ??ch cho m???i ng?????i, ?????c bi???t l?? b???nh nh??n ung th??. L?? tr??? l?? gi??o s?? t???i Tr?????ng Khoa h???c Y t??? thu???c Vi???n Gi??o d???c ?????i h???c Caritas, Lai b???t ?????u s??? nghi???p y t??. Trong khi l??m vi???c trong l??nh v???c ch??m s??c h???i ph???c, c?? ???? h???c ???????c c??ch li???u ph??p h????ng th??m ???????c s??? d???ng nh?? m???t ph????ng ph??p ??i???u tr??? b??? sung l??m d???u c??c tri???u ch???ng th??? ch???t v?? t??m l?? c???a b???nh nh??n.</p>';
        $content .= '<h5>A4 - L???i ??ch c???a ch??ng ?????i v???i tinh th???n v?? th??? ch???t</h5>';
        $content .= '<p>Trong khi li???u ph??p h????ng th??m c?? th??? c?? nhi???u t??c d???ng t??ch c???c v??? m???t sinh l??, c??? Cheung v?? Lai ?????u kh??ng kh???ng ?????nh r???ng n?? n??n ???????c s??? d???ng thay cho c??c ph????ng ph??p ??i???u tr??? v?? y h???c hi???n ?????i. Thay v??o ????, li???u ph??p h????ng th??m c?? th??? l?? m???t b??? sung c?? l???i.</p>';
        $content .= '<blockquote>D??? li???u cho th???y, t??? m???c 30 ????? C tr??? ??i, c??? 1 ????? t??ng, trung b??nh gi???c ng??? c???a m???i ng?????i gi???m 14 ph??t. Nhi???t ????? c??ng cao, th???i gian ng??? c??ng gi???m (??t h??n 7 ti???ng m???i ng??y). Khi ????, con ng?????i s??? c?? xu h?????ng ng??? mu???n v?? d???y s???m h??n.</blockquote>';
        $content .= '<h6>A5 - L???i ??ch c???a ch??ng ?????i v???i tinh th???n v?? th??? ch???t</h6>';
        $content .= '<p>K???t qu??? n??y ???????c <a href="https://cyou.vn">CYou VietNam</a> thu th???p t??? m???t th?? nghi???m quy m?? to??n c???u, v???i s??? tham gia c???a h??n 47,600 ng?????i ?????n t??? 68 qu???c gia. T???t c??? ?????u ???????c theo d??i b???i m???t v??ng ??eo tay c?? ch???c n??ng ghi l???i th??i quen ng???, b???t ?????u t??? th??ng 9 n??m 2015 ?????n th??ng 10 n??m 2017.</p>';
        $content .= '<ul>';
        $content .= '<li>?????i thu???c melatonin l???y m???t ??t anh ????o chua.</li>';
        $content .= '<li>Hai mu???ng mu???i Epsom trong b???n n?????c ???m.</li>';
        $content .= '<li>?????i Netflix l???y m???t cu???n s??ch.</li>';
        $content .= '<li>?????i ph???n b??? sung vitamin D cho ??nh n???ng bu???i s??ng s???m.</li>';
        $content .= '<li>?????i c?? ph?? bu???i s??ng l???y n?????c c?? ch???t ??i???n gi???i (ho???c chanh t????i).</li>';
        $content .= '<li>?????i b??nh k???o l???y protein.</li>';
        $content .= '<li>????nh ?????i t??ch c?? ph?? espresso ????? l???y n??ng l?????ng c???a t??? nhi??n. </li>';
        $content .= '</ul>';
        $content .= '<p>Vitamin D (1.000-2.000 IU m???i ng??y) l?? c???n thi???t ?????i v???i h???u h???t ng?????i l???n, ngay c??? nh???ng ng?????i s???ng trong khu v???c ti???p x??c v???i ??nh n???ng m???t tr???i th?????ng xuy??n, nh??ng kh??ng thi???t l???p nh???p sinh h???c ????? ph??i n???ng m???i s??ng s???m. Th??m v??o ????, ??nh n???ng c???a bu???i s??ng s???m c?? ??t tia UVA v?? UVB nguy hi???m h??n so v???i ??nh n???ng bu???i chi???u.</p>';
        $content .= '<p>?????ng hi???u sai ?? t??i, t??i th??ch phim tr???c tuy???n- nh??ng t??i ???? nh???n ra r???ng vi???c h???p th??? qu?? nhi???u ??nh s??ng xanh t??? m??n h??nh tivi sau khi tr???i t???i l??m t??ng lo l???ng h??ng ????m v?? khi???n t??i kh?? ng??? h??n. H??y th??? s???c ??i???n tho???i c???a b???n v?? ?????t n?? ??? ch??? ????? im l???ng trong ph??ng kh??c v?? l??n gi?????ng v???i m???t cu???n s??ch.</p>';

        for ($i = 0; $i < 99; $i++) {
            $post = array();
            $post['post_category'] = array($cat_id);
            $post['post_status'] = 'publish';
            $post['post_type'] = 'post';
            $post['post_title'] = $posts[$i];
            $post['post_content'] = $content;
            $post_id = wp_insert_post($post);

            //Featured Image
            $imageUrl = home_url('/demo/posts/') . $images[$i];
            $image_name = basename(parse_url($imageUrl, PHP_URL_PATH));
            $upload_dir = wp_upload_dir();
            $image_data = file_get_contents($imageUrl);
            $unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
            $file_name = basename($unique_file_name);
            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'] . '/' . $file_name;
            } else {
                $file = $upload_dir['basedir'] . '/' . $file_name;
            }
            file_put_contents($file, $image_data);
            $wp_filetype = wp_check_filetype($file_name, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($file_name),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment($attachment, $file);
            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);
            set_post_thumbnail($post_id, $attach_id);
        }
    }
}

new Dummy();
