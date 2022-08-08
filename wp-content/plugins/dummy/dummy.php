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
            "Bóng sấy quần áo mang lại nhiều công dụng hữu ích, bạn đã nghe đến chưa?",
            "5 trải nghiệm chăm sóc sức khỏe ở Bali, từ liệu pháp ánh sáng đến hít thở.",
            "Nghệ sĩ Vpop đang thể hiện mối quan tâm của mình với môi trường qua sản phẩm âm nhạc",
            "Thế giới đã làm gì để tận dụng những chiếc bánh mì thừa, góp phần giảm thiểu lãng phí thực phẩm",
            "Anh báo động đỏ khi đón nhận mức nhiệt kỷ lục.",
            "Cách Ấn Độ tận dụng những bông hoa cúng để sản xuất hương",
            "Tái sử dụng tab nhôm trên những lon nước ngọt nắp giật để đan túi hàng hiệu giá hơn 600$",
            "Người phụ nữ biến phế thải từ các công trường thành đồ nội thất cao cấp giá hàng nghìn đô la",
            "Chế tạo cá robot làm nhiệm vụ thu gom hạt vi nhựa ngoài đại dương",
            "Vitamin D từ ánh nắng mặt trời có thể giúp ngăn ngừa chứng mất trí nhớ và chống lại các bệnh khác.",
            "Vì sao nói gỗ xoài là một nguyên liệu hữu ích?",
            "14 loài thuộc Bộ Cá voi đang có nguy cơ tuyệt chủng - Phần 2",
            "Hành vi \"phá hoại\" cây bạc hà mèo là cách các \"boss\" đuổi muỗi?",
            "Vitamin D từ ánh nắng mặt trời có thể giúp ngăn ngừa chứng mất trí nhớ và chống lại các bệnh khác.",
            "Plastitar – hỗn hợp trộn giữa hắc ín và vi nhựa đang trở thành mối đe dọa mới cho sự sống ngoài đại dương",
            "Sáng tạo hộp giữ nhiệt đựng thực phẩm từ vật liệu xây dựng dư thừa",
            "Biến đổi khí hậu đang ảnh hưởng lên cả những chiếc pizza",
            "K-drama Why Her? Seo Hyun-jin vào vai một luật sư độc ác.",
            "Khí hậu nóng lên là nguyên nhân khiến số người gặp chứng mất ngủ gia tăng",
            "Không chỉ lưu trữ carbon, rừng còn làm được nhiều hơn thế",
            "Meta chi 27 triệu USD để đảm bảo an ninh cho Mark Zuckerberg trong năm 2021",
            "Một cơ quan chính phủ Hoa Kỳ đã vô tình giết nhầm gần 3,000 động vật cần được bảo vệ vào năm 2021",
            "Menu tại các nhà hàng nay phải thống kê lượng calo cho mỗi món",
            "Thế hệ Z của Trung Quốc muốn các thương hiệu 'Trung Quốc sang trọng' chứ không phải các thương hiệu nước ngoài.",
            "Tổng thống Mỹ Joe Biden tổ chức tiệc cưới cho cháu gái tại Nhà Trắng",
            "Khoa học đang nghiên cứu về cách nấm “trò chuyện”",
            "Thế hệ Gen Z thay đổi thói quen mua sắm thời trang vì lo lắng về biến đổi khí hậu.",
            "Tránh xa mạng xã hội trong hơn 4 năm qua giúp tôi hạnh phúc hơn",
            "Cuốn sổ ghi chép quá trình tiến hoá bị mất của Charles Darwin trở lại thư viện Cambridge sau hai thập kỷ biến mất",
            "Giun trở thành loài xâm lấn, gây hại cho những loại côn trùng khác ở Bắc Mỹ",
            "5 loại thực phẩm giàu prebiotic sẵn có trong bếp của bạn",
            "Thánh địa của người Inca - Machu Picchu bị gọi nhầm tên trong hơn 100 năm",
            "Hành trình “đặt chân” lên đất Mỹ của cây hoa anh đào Nhật Bản",
            "Bạn nên ăn loại trái cây này 2 lần mỗi tuần để giảm nguy cơ mắc bệnh tim mạch",
            "Cách các lớp học trực tuyến thay đổi não bộ của trẻ em, làm xói mòn khả năng phục hồi của trẻ và khiến một số trẻ kiệt sức hoặc chán nản",
            "Tại sao ánh sáng tự nhiên lại tốt cho sự phát triển của trẻ em",
            "Gạch xây nhà tái chế từ rác thải nhựa và cát, cứng gấp 5 lần bê tông",
            "5 nguyên tắc đáng nhớ để chú rể xuất hiện nổi bật trong ngày cưới",
            "Bụi Mặt Trăng do Neil Armstrong thu thập chuẩn bị được đưa ra bán đấu giá",
            "Nguồn gốc của buổi tiệc độc thân dành cho cô dâu - The Bridal Shower",
            "Top 5 du thuyền lớn nhất tại triển lãm du thuyền hàng đầu thế giới Palm Beach",
            "Ô nhiễm không khí làm tăng khả năng trầm cảm ở thanh thiếu niên",
            "Đường hữu cơ từ cây thùa có thuần chay? Liệu nó có tốt hơn những loại đường khác?",
            "5 điều đáng suy nghĩ để xem nàng đã sẵn sàng lấy chồng chưa?",
            "Vì sao xu hướng ghosting giữa nhà tuyển dụng và nhân viên ngày càng phổ biến?",
            "Chú chó ngày nào cũng ra biển ngồi đợi người chủ sẽ không bao giờ trở về",
            "Nữ nghệ sĩ bất tử hóa vẻ đẹp của thiên nhiên qua những bức phù điêu",
            "Gạch lát nền từ muội than (black carbon) trong không khí ô nhiễm",
            "Bùng nổ xu hướng sử dụng đồ “qua tay” – quần áo secondhand.",
            "Tóm tắt Stranger Things mùa 4: Mọi thứ từ Eleven",
            "Asus công bố màn hình chơi game Nvidia G-Sync 500Hz đầu tiên trên thế giới",
            "Những sự thật có thể bạn chưa biết về loài voi",
            "Tại sao bác sĩ khuyên nên ăn 30 loại thực vật khác nhau mỗi tuần để giữ cho hệ vi sinh vật tiêu hóa ở trạng thái tốt",
            "Tủ lạnh bằng đất sét không cần dùng điện cho người dân nghèo ở Ấn Độ",
            "Sự cố tiền điện tử có gây ra mối đe dọa cho hệ thống tài chính không?",
            "20 người nổi tiếng dường như không già đi kể từ năm 2000",
            "Các loại nhựa thông thường thải ra hàng nghìn tỷ hạt nano khi tiếp xúc với nước nóng",
            "Hàm lượng dinh dưỡng trong trái cây và rau củ đang giảm dần",
            "Bao bì mini-sized và mẫu thử của mỹ phẩm làm đẹp: kẻ phá hoại môi trường thầm lặng chúng ta đã vô tình bỏ qua",
            "Biến chất thải lỏng độc hại từ hoạt động khai thác mỏ thành màu vẽ",
            "Người cha Trung Quốc yêu cầu con gái 11 tuổi đào củ sen giữa trời nắng nóng gay gắt để dạy con giá trị giáo dục",
            "Ốc xà cừ khổng lồ - biểu tượng của các bãi biển bang Florida - đang có nguy cơ tuyệt chủng",
            "Tại sao mọi người nên quan tâm đến mất đa dạng sinh học",
            "Hoạ sĩ Motoo Abiko - Người cộng sự của cha đẻ “Doraemon” qua đời",
            "Loài hoa có thể tự làm mật ngọt ngào hơn khi nghe tiếng ong vo ve đến gần",
            "Cà phê và lợi ích sức khỏe tim mạch: uống 2 đến 3 tách mỗi ngày giúp bạn sống lâu hơn",
            "Bánh Oreos có thuần chay không?",
            "Đồ nội thất làm từ lá cây, vỏ trái cây",
            "Grid - Bộ phim khoa học viễn tưởng của Disney, khởi đầu tốt nhưng biến thành một mớ hỗn độn du hành thời gian khác của Hàn Quốc",
            "Twitter chấp nhận lời đề nghị ban đầu trị giá 43 tỷ đô la của Musk",
            "Leicester kỷ niệm Ngày Trái Đất với quả địa cầu khổng lồ làm bằng rác thải thu gom từ công viên thành phố",
            "Máy thám hiểm của NASA ghi hình nhật thực trên sao Hỏa",
            "5 thần tượng K-pop được mệnh danh là 'vũ khí bí mật'- ai đã nổi tiếng ngay cả trước khi họ ra mắt?",
            "Can thiệp khí hậu bằng geo-engineering làm tăng nguy cơ mắc bệnh sốt rét",
            "Bức tranh 400 tuổi có giá hàng triệu USD bất ngờ được tìm thấy trong nhà kho",
            "Màng bọc thực phẩm ăn được từ tinh bột sắn của nhóm sinh viên Đại học Bách khoa, TP.HCM",
            "IKEA sẽ mua lại đồ nội thất cũ từ bạn",
            "Breathaboard – vật liệu xanh thay thế cho tường vách thạch cao",
            "Từ năm 2026, Việt Nam sẽ xử phạt những nhà bán lẻ cung cấp túi nylon dùng một lần cho khách hàng",
            "Người Hàn Quốc sẽ sớm được \"trẻ ra\" một năm tuổi trong thời gian tới?",
            "Vương quốc Anh: Đề xuất cho phép xem tv khi đang sử dụng xe tự lái trên cao tốc",
            "Hoa Kỳ chấp thuận chăn thả bò rừng trên thảo nguyên Montana trong cơn bão dư luận",
            "Thực vật đóng vai trò quan trọng trong việc phát triển các phương pháp điều trị ung thư trong tương lai",
            "Chính phủ Mỹ phải trả hàng triệu USD để bảo dưỡng du thuyền của các tỷ phú Nga bị trừng phạt",
            "Biến hộp bánh kẹo thành tác phẩm nghệ thuật",
            "Những khu rừng đầu tiên",
            "New York: Một số người dân kiếm hàng chục nghìn USD nhờ báo cáo lái xe vi phạm",
            "Sinh viên làm giấy từ thân cây chuối",
            "Sao Hải Vương trải qua các đợt thay đổi nhiệt bất thường chưa được lý giải",
            "3 công thức làm mặt nạ giúp se khít lỗ chân lông tại nhà",
            "Học 9 chiêu làm đẹp từ các ngôi sao đình đám thế giới để nhan sắc thăng hạng",
            "Thêm một thành phần cứ kết thân với retinol là nhân đôi hiệu quả \"chống già\" cho các chị em",
            "5 kiểu giày công sở dễ phối đồ nhất, nên sắm hết để mặc đẹp mỗi ngày",
            "Bôi kem chống nắng và đeo khẩu trang cùng lúc dễ sẽ gây mụn vì bí da, muốn khắc phục tình trạng này chỉ cần lưu ý những điều sau",
            "6 chiêu lên đồ giúp tăng điểm sang chảnh mà không tốn kém tiền bạc",
            "3 biện pháp khắc phục hiệu quả rụng tóc sau sinh",
            "Muốn sở hữu vẻ lịch sự khi đi ăn cưới thì đây là 3 lưu ý chị em nên nhớ",
            "4 kiểu chân váy làm nên phong cách sang trọng của phụ nữ Pháp",
            "3 màu tóc nhuộm sáng bừng tông da, chị em nhất định phải thử trong năm 2022 này",
            "Giấm táo, \"đồng minh\" làm đẹp tự nhiên cho da dầu và tóc xỉn màu",
            "Ngoài kem chống nắng, nàng 30+ cần thực hiện thêm 3 bước này để ngăn ngừa lão hóa da",
            "2 sai lầm khi bôi kem dưỡng khiến cho làn da mãi không đẹp lên được",
            "3 cách massage giúp giảm rụng tóc, kích thích tóc mọc",
            "Tips chọn đồ tôn dáng, sáng da cho cô nàng da ngăm đen",
        ];

        $content = '<p>Bộ Cá voi là một bộ các loài động vật có vú sống dưới nước bao gồm cá voi, cá heo, cá heo chuột, cá nhà táng và kỳ lân biển. Dựa vào đặc điểm sinh học mà chúng lại được chia thành hai phân bộ là Cá voi tấm sừng hàm (Mysticeti) và Cá voi có răng (Odontoceti). Cho dù ở phân bộ nào, những loài động vật này đều đang phải đối mặt với nguy cơ tuyệt chủng theo những cách khác nhau.</p>';
        $content .= '<p>Theo danh sách của Liên minh Bảo tồn Thiên nhiên Quốc tế, có 14 trong số 89 loài thuộc bộ cá voi còn tồn tại hiện nay đang ở tình trạng nguy cấp hoặc cực kỳ nguy cấp. Cụ thể bao gồm 5 loài cá voi, 7 loài cá heo và 2 loài cá heo chuột.</p>';
        $content .= '<h2>A1 - Cá voi trơn Bắc Đại Tây Dương – Cực kì nguy cấp</h2>';
        $content .= '<p>Vì có hàm lượng chất béo cao và dễ bắt gặp, cá voi trơn Bắc Đại Tây Dương là đối tượng săn bắt chủ yếu nhất vào thế kỉ 18 và 19. Tên tiếng anh của loài cá voi này là North Atlantic “Right” Whale. Chữ “Right” xuất phát từ tư tưởng: chúng là loài “phù hợp” để săn bắt do bơi gần bờ và dễ dàng nổi lên mặt nước sau khi bị giết.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-1.jpeg"/>';
        $content .= '<h3>A1-1 - Cá heo Baiji – Có thể đã tuyệt chủng</h3>';
        $content .= '<p>Ngày nay, tổng số lượng cá thể cá voi trơn còn tồn tại chỉ khoảng 500, với 400 ở phía tây bắc Đại Tây Dương và ít hơn 100 ở khu vực phía đông Bắc Đại Tây Dương.</p>';
        $content .= '<p>Cá heo Baiji, hay Cá heo Sông Dương Tử, hiếm gặp đến mức chúng được coi là đã gần như hoàn toàn tuyệt chủng. Năm 2006, các nhà khoa học chính thức tuyên bố sự tuyệt chúng của cá heo Baiji, mặc dù sau đó một người dân địa phương lại cho rằng đã nhìn thấy chúng vào năm 2016. Nếu sự thật đúng như tuyên bố của các nhà khoa học, cá heo Baiji sẽ là loài cá heo đầu tiên tuyệt chủng vì chịu tác động phía từ con người.</p>';
        $content .= '<p>Baiji là loài đặc hữu của sông Dương Tử, được người dân kính trọng gọi với danh xưng “nữ thần sông”. Tuy nhiên, do hoạt động đánh bắt khiến nguồn thức ăn của cá heo Baiji bị cạn kiệt, đồng thời hoạt động xả thải công nghiệp làm ô nhiễm môi trường sống, chúng đã gần như hoàn toàn biến mất từ năm 2002. Vì sự kiện người dân cho rằng đã nhìn thấy chúng năm 2016, các nhà khoa học lại một lần nữa dấy lên hi vọng và chuyển chúng từ trạng thái đã tuyệt chủng thành cực kì nguy cấp.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-2.jpeg"/>';
        $content .= '<h3>A1-2Lịch sử của liệu pháp hương thơm</h3>';
        $content .= '<p>Từ 2.400 năm trước, “cha đẻ của ngành y học” đã hiểu được sức mạnh của chất thơm trong việc phục hồi sức khỏe của một người. Hippocrates nói: “Việc chữa bệnh bắt đầu bằng việc tắm nước thơm và mát-xa hàng ngày”. </p>';
        $content .= '<p>Một trong những lợi ích lớn nhất của quả bóng sấy là chúng sấy khô hiệu quả hơn nhiều so với các tấm sấy và máy sấy thông thường. Những quả bóng này sẽ làm khô nhanh hơn tới 40% nhờ vào việc chúng hấp thụ độ ẩm sau khi giặt. Từ đó giúp tiết kiệm được nhiều năng lượng hơn.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-3.jpeg"/>';
        $content .= '<h3>A1-3 - Tiết kiệm thời gian giặt sấy</h3>';
        $content .= '<p>“Nó có nhiều ảnh hưởng đến hoạt động bình thường của cơ thể. Ví dụ, gần đây chúng tôi đã chỉ ra rằng cùng một loại thiếu hụt nghiêm trọng làm tăng nguy cơ sa sút trí tuệ cũng có liên quan đến nguy cơ viêm nhiễm mức độ thấp và bệnh tim lớn hơn”.</p>';
        $content .= '<p>Cô nói, nghiên cứu của Hypponen, công trình lớn nhất từ trước đến nay, với hơn 300.000 người tham gia, đã được truyền cảm hứng, bởi vì “từ lâu người ta đã nghi ngờ các thụ thể vitamin D làm trung gian cho các tác động của hormone hoạt động có trong não người, và kết quả là nó có thể có những tác động đối với sự phát triển của các bệnh về nhận thức thần kinh như chứng sa sút trí tuệ”.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-4.jpeg"/>';
        $content .= '<h2>A2 - Ủ bia bằng bánh mì thừa ở London, Anh</h2>';
        $content .= '<p>Thứ nhất, sự hiện diện của các thụ thể vitamin D ở vùng dưới đồi cho thấy rằng vitamin D hoạt động sẽ thúc đẩy sự phát triển và trưởng thành của các tế bào thần kinh - các chất dẫn truyền thông tin trong não.</p>';
        $content .= '<p>Thứ hai, vitamin D hoạt tính có liên quan đến việc giảm đông máu và điều chỉnh hệ thống ảnh hưởng đến huyết áp - giúp bảo vệ chống lại đột quỵ , có thể là chất xúc tác cho chứng sa sút trí tuệ.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-5.jpeg"/>';
        $content .= '<h3>A2 - 1 - Thành phố Rotterdam dùng bánh mì bỏ đi để tái tạo thành năng lượng</h3>';
        $content .= '<p>Hypponen nói rằng chế độ ăn uống là một nguồn cung cấp vitamin D nghèo nàn; Trong khi một số thực phẩm như cá dầu, trứng và sữa có chứa một số vitamin D, thực tế là không thể có đủ từ thực phẩm, trừ khi chế độ ăn uống cũng bao gồm các sản phẩm thực phẩm được tăng cường vitamin D.</p>';
        $content .= '<p>Cô nói rằng không phải lúc nào cũng cần một bài kiểm tra. Những người có lối sống năng động và thường xuyên ra ngoài trời trong những giờ có ánh sáng mặt trời, có khả năng có đủ lượng vitamin D trong năm. Trong những tháng mùa đông ít nắng, bổ sung vitamin D đơn giản không cần kê đơn có thể giúp duy trì mức độ đó.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-6.jpeg"/>';
        $content .= '<h3>A2 - 2 - Biến bánh mì thừa trở lại thành bột để tiếp tục sử dụng ở Pháp</h3>';
        $content .= '<p>“Chúng tôi thấy tác động mạnh nhất đến nguy cơ sa sút trí tuệ với những người tham gia có nồng độ rất thấp (dưới 25nmol / L). Nguy cơ tăng nhẹ đối với những người ở trong khoảng 25-50 nmol / L, nhưng hầu hết, theo mô hình của chúng tôi, dường như những người đã đạt được mức từ 50 nmol / L trở lên gần như không có nguy cơ”.</p>';
        $content .= '<p>Nó cho thấy rằng ngăn ngừa sự thiếu hụt vitamin D trong dân số sẽ giúp giảm nguy cơ sa sút trí tuệ, cũng như các nguy cơ có thể tránh được của nhiều bệnh khác, cô nói.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-7.jpeg"/>';
        $content .= '<h3>A2 - 3 - Nghiên cứu của Hypponen có ý nghĩa như thế nào?</h3>';
        $content .= '<p>NHS cho biết bạn không thể dùng quá liều vitamin D khi tiếp xúc với ánh nắng mặt trời. Nhưng bạn có thể bị cháy nắng. Vì vậy, hãy che chắn và bảo vệ da bằng kem chống nắng có chỉ số SPF cao. May mắn thay, trong suốt mùa hè, hầu hết mọi người chỉ cần ở dưới ánh nắng chói chang vài phút mỗi ngày để có đủ vitamin D.</p>';
        $content .= '<p>Nhưng chất dinh dưỡng nhỏ bé quan trọng này đã có lịch sử lâu đời ngay cả trước khi Windaus giải thích. Còi xương, bệnh xương do thiếu vitamin D, đã được ghi nhận hơn 200 năm và lần đầu tiên được mô tả trong các tài liệu y khoa vào năm 1650.</p>';
        $content .= '<img class="aligncenter" src="https://basewp.lndo.site/demo/anh-8.jpeg"/>';
        $content .= '<h3>A2 - 4 - Mùi hương ảnh hưởng như thế nào đến hạnh phúc?</h3>';
        $content .= '<p>Trong những năm gần đây, loại vitamin tan trong chất béo này được quảng cáo là tốt cho chúng ta theo nhiều cách, từ bảo vệ sức khỏe của xương đến tăng cường khả năng miễn dịch. Các nghiên cứu trong phòng thí nghiệm cho thấy vitamin D thậm chí có thể làm giảm sự phát triển của tế bào ung thư, giúp kiểm soát nhiễm trùng và giảm viêm.</p>';
        $content .= '<p>Sau khi xé nhỏ số bánh mì cũ, họ sẽ đưa chúng qua máy nghiền thành vụn nhỏ và dùng số vụn này thay thế 20% lượng bột mì cần sử dụng trong mỗi mẻ bánh. Bánh thành phẩm khi ra lò mặc dù có màu đậm hơn nhưng hương vị hoàn toàn không bị ảnh hưởng.</p>';
        $content .= '<caption class="wp-caption aligncenter"><img src="https://basewp.lndo.site/demo/anh-9.jpeg"/><figcaption class="wp-caption-text">Vì sao nói gỗ xoài là một nguyên liệu hữu ích?</figcaption></caption>';
        $content .= '<p>Nhắc đến bánh mì không thể bỏ qua Pháp. Người dân Pháp sử dụng bánh mì như một món ăn chính hàng ngày và chỉ ưa chuộng bánh mì tươi, không qua đóng gói bảo quản. Đó là lí do tại sao có đến hơn 150,000 tấn bánh mì bị bỏ đi ở Pháp mỗi năm.</p>';
        $content .= '<p>Guillaume Devinat, chủ của một trong số hơn 100 tiệm bánh ở Pháp đang sử dụng loại máy này, chia sẻ anh cùng những người thợ tại cửa hàng đang thử một công thức bánh mì baguette mới có chứa thành phần “bột” nghiền từ những chiếc bánh mì thừa chưa bán được ngày hôm trước.</p>';
        $content .= '<p>Guillaume Devinat cho biết thêm nếu được làm khô đúng cách, vụn bánh mì có thể bảo quản vài tháng và vì được nhiều khách hàng ủng hộ, anh cũng đang thử nghiệm thêm nhiều công thức khác sử dụng thành phần “vụn bánh mì giải cứu”.</p>';
        $content .= '<h4>A3 - Lợi ích của chúng đối với tinh thần và thể chất</h4>';
        $content .= '<p>Cheung cho biết các loại tinh dầu mang lại nhiều lợi ích cho khách hàng của mình: một số có làn da trông trẻ hơn và tóc mọc rõ rệt, những người khác đã sử dụng tinh dầu để xoa dịu cơn đau kinh nguyệt đồng thời giảm thiểu vết rạn da. Nhiều người trong số họ sử dụng tinh dầu tại chỗ, thông qua kem dưỡng da hoặc gel.</p>';
        $content .= '<p>Trong quá trình thực hành và nghiên cứu của mình, Tiến sĩ Theresa Lai Tze-kwan cũng đã chứng kiến ​​cách liệu pháp hương thơm có thể giúp ích cho mọi người, đặc biệt là bệnh nhân ung thư. Là trợ lý giáo sư tại Trường Khoa học Y tế thuộc Viện Giáo dục Đại học Caritas, Lai bắt đầu sự nghiệp y tá. Trong khi làm việc trong lĩnh vực chăm sóc hồi phục, cô đã học được cách liệu pháp hương thơm được sử dụng như một phương pháp điều trị bổ sung làm dịu các triệu chứng thể chất và tâm lý của bệnh nhân.</p>';
        $content .= '<h5>A4 - Lợi ích của chúng đối với tinh thần và thể chất</h5>';
        $content .= '<p>Trong khi liệu pháp hương thơm có thể có nhiều tác dụng tích cực về mặt sinh lý, cả Cheung và Lai đều không khẳng định rằng nó nên được sử dụng thay cho các phương pháp điều trị và y học hiện đại. Thay vào đó, liệu pháp hương thơm có thể là một bổ sung có lợi.</p>';
        $content .= '<blockquote>Dữ liệu cho thấy, từ mức 30 độ C trở đi, cứ 1 độ tăng, trung bình giấc ngủ của mỗi người giảm 14 phút. Nhiệt độ càng cao, thời gian ngủ càng giảm (ít hơn 7 tiếng mỗi ngày). Khi đó, con người sẽ có xu hướng ngủ muộn và dậy sớm hơn.</blockquote>';
        $content .= '<h6>A5 - Lợi ích của chúng đối với tinh thần và thể chất</h6>';
        $content .= '<p>Kết quả này được <a href="https://cyou.vn">CYou VietNam</a> thu thập từ một thí nghiệm quy mô toàn cầu, với sự tham gia của hơn 47,600 người đến từ 68 quốc gia. Tất cả đều được theo dõi bởi một vòng đeo tay có chức năng ghi lại thói quen ngủ, bắt đầu từ tháng 9 năm 2015 đến tháng 10 năm 2017.</p>';
        $content .= '<ul>';
        $content .= '<li>Đổi thuốc melatonin lấy một ít anh đào chua.</li>';
        $content .= '<li>Hai muỗng muối Epsom trong bồn nước ấm.</li>';
        $content .= '<li>Đổi Netflix lấy một cuốn sách.</li>';
        $content .= '<li>Đổi phần bổ sung vitamin D cho ánh nắng buổi sáng sớm.</li>';
        $content .= '<li>Đổi cà phê buổi sáng lấy nước có chất điện giải (hoặc chanh tươi).</li>';
        $content .= '<li>Đổi bánh kẹo lấy protein.</li>';
        $content .= '<li>Đánh đổi tách cà phê espresso để lấy năng lượng của tự nhiên. </li>';
        $content .= '</ul>';
        $content .= '<p>Vitamin D (1.000-2.000 IU mỗi ngày) là cần thiết đối với hầu hết người lớn, ngay cả những người sống trong khu vực tiếp xúc với ánh nắng mặt trời thường xuyên, nhưng không thiết lập nhịp sinh học để phơi nắng mỗi sáng sớm. Thêm vào đó, ánh nắng của buổi sáng sớm có ít tia UVA và UVB nguy hiểm hơn so với ánh nắng buổi chiều.</p>';
        $content .= '<p>Đừng hiểu sai ý tôi, tôi thích phim trực tuyến- nhưng tôi đã nhận ra rằng việc hấp thụ quá nhiều ánh sáng xanh từ màn hình tivi sau khi trời tối làm tăng lo lắng hàng đêm và khiến tôi khó ngủ hơn. Hãy thử sạc điện thoại của bạn và đặt nó ở chế độ im lặng trong phòng khác và lên giường với một cuốn sách.</p>';

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
