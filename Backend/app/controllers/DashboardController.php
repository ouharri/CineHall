<?php

use JetBrains\PhpStorm\NoReturn;
use Mpdf\MpdfException;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class DashboardController
{
    protected mixed $PreviewUrl;

    public function __construct()
    {
        redirect::admin();
        $this->PreviewUrl = $_SERVER['HTTP_REFERER'] ?? url();
    }

    public function P404(): void
    {
        View::load('dashboard/P404');
    }

    /**
     */
    public function category(): void
    {
        $category = new Category();
        $data['category'] = $category->getAll();
        view::load('dashboard/category', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    public function addCategory(): void
    {
        $history = new History();
        $category = new category();
        if (isset($_POST['submitBtn'])) {
            $flag = true;
            extract($_POST);
            for ($i = 0; $i < count($_POST['productType']); $i++) {
                $data = array(
                    'libel' => $_POST['productType'][$i],
                    'desc' => $_POST['desc'][$i]
                );
                if ($category->insert($data)) {
                    $data = array(
                        'users' => $_SESSION['user']['id_u'],
                        'item' => $_POST['productType'][$i],
                        'action' => 'Add',
                        'role' => 'category'
                    );
                    $history->insert($data);
                } else {
                    $flag = false;
                }
            }
            if ($flag) {
                notif::add('Category added successfully');
            } else {
                notif::add('Something wrong went !', 'error');
            }
            redirect('dashboard/addcategory');
            exit();
        }
        view::load('dashboard/addCategory');
    }

    /**
     * @throws Exception|\Exception
     */
    public function editCategory($id = 0): void
    {
        $data = [];
        $history = new history();
        $typeProduct = new category();
        if (isset($_POST['submit'])) {
            extract($_POST);
            $data = array(
                'libel' => $_POST['category'],
                'desc' => $_POST['desc']
            );
            if ($typeProduct->update($id, $data)) {
                $data = array(
                    'users' => $_SESSION['user']['id_u'],
                    'item' => $_POST['category'],
                    'action' => 'Edit',
                    'role' => 'category'
                );
                $history->insert($data);
                notif::add('category edited successfully');
            } else {
                notif::add('error in edit category', 'error');
            }
            redirect('dashboard/category');
            exit();
        } else if ($id != 0) {
            $tmp = $typeProduct->getRow($id);
            $data['libel'] = $tmp['libel'];
            $data['desc'] = $tmp['desc'];
            $data['id'] = $tmp['id'];
        }
        view::load('dashboard/editCategory', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    #[NoReturn] public function deletCategory($id): void
    {
        $category = new category();
        $history = new History();
        $tmp = $category->getRow($id)['libel'];
        if ($category->delete($id)) {
            $data = array(
                'users' => $_SESSION['user']['id_u'],
                'item' => $tmp,
                'action' => 'Delet',
                'role' => 'category'
            );
            $history->insert($data);
            notif::add('category deleted successfully');
        } else {
            notif::add('error in delete category', 'error');
        }
        redirect('dashboard/category');
        exit();
    }

    /**
     * @throws Exception|\Exception
     */
    public function product(): void
    {
        $product = new product();
        $category = new category();
        $data['products'] = $product->getAll();
        for ($i = 0; $i < count($data['products']); $i++) {
            $data['products'][$i]['category'] = $category->getRow($data['products'][$i]['category'])['libel'];
        }
        view::load('dashboard/product', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    public function addProduct(): void
    {
        $data = [];
        $product = new product();
        $history = new history();
        if (isset($_POST['Libel'])) {
            $flag = true;
            extract($_POST);
            for ($i = 0; $i < count($_POST['Libel']); $i++) {
                $data = array(
                    'category' => (int)validateData::validate_data($_POST['category'][$i]),
                    'libel' => validateData::validate_data($_POST['Libel'][$i]),
                    'qnt' => validateData::validate_data($_POST['qty'][$i]),
                    'price' => validateData::validate_data($_POST['price'][$i]),
                    'img' => file_get_contents($_FILES['image']['tmp_name'][$i]),
                    'desc' => validateData::validate_data($_POST['desc'][$i]),
                    'codeBar' => validateData::validate_data($_POST['barCode'][$i]),
                    'expirationDate' => validateData::validate_data($_POST['expirationDate'][$i]),
                    'company' => validateData::validate_data($_POST['company'][$i])
                );
                if ($product->insert($data)) {
                    $data = array(
                        'item' => validateData::validate_data($_POST['Libel'][$i]),
                        'users' => $_SESSION['user']['id_u'],
                        'action' => 'Add',
                        'role' => 'product'
                    );
                    $history->insert($data);
                } else {
                    $flag = false;
                }
            }
            if ($flag) {
                notif::add('product added successfully', 'success');
            } else {
                notif::add('Something wrong went.', 'error');
            }
            redirect('dashboard/addproduct');
            exit();
        } else {
            $category = new category();
            $data['category'] = $category->getAll();
        }
        view::load('dashboard/addProduct', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    public function editProduct($id = 0): void
    {
        $data = [];
        $product = new product();
        $history = new History();
        if (isset($_POST['Libel'])) {
            extract($_POST);
            $data = array(
                'category' => (int)validateData::validate_data($_POST['category']),
                'libel' => validateData::validate_data($_POST['Libel']),
                'qnt' => validateData::validate_data($_POST['qty']),
                'price' => validateData::validate_data($_POST['price']),
                'desc' => validateData::validate_data($_POST['desc']),
                'codeBar' => validateData::validate_data($_POST['barCode']),
                'expirationDate' => validateData::validate_data($_POST['expirationDate']),
                'company' => validateData::validate_data($_POST['company'])
            );
            if (!empty($_FILES['image']['tmp_name'])) $data = array_merge($data, ['img' => file_get_contents($_FILES['image']['tmp_name'])]);
            if ($product->update($id, $data)) {
                $data = array(
                    'item' => validateData::validate_data($_POST['Libel']),
                    'users' => $_SESSION['user']['id_u'],
                    'action' => 'Edit',
                    'role' => 'product'
                );
                $history->insert($data);
                notif::add('product edited successfully', 'success');
            } else {
                notif::add('error in edit product', 'error');
            }
            redirect('dashboard/product');
            exit();
        } else if ($id != 0) {
            if ($product->getRow($id)) {
                $category = new category();
                $data['category'] = $category->getAll();
                $data['product'] = $product->getRow($id);
                $data['product']['category'] = $category->getRow($data['product']['category'])['libel'];
            } else {
                redirect('dashboard/P404');
                exit();
            }
        }
        view::load('dashboard/editProduct', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    #[NoReturn] public function deletproduct($id): void
    {
        $product = new product();
        $history = new History();
        $tmp = $product->getRow($id)['libel'];
        if ($product->delete($id)) {
            $data = array(
                'users' => $_SESSION['user']['id_u'],
                'item' => $tmp,
                'action' => 'Delet',
                'role' => 'product'
            );
            $history->insert($data);
            notif::add('product deleted successfully');
        } else {
            notif::add('error in deleted product', 'error');
        }
        redirect('dashboard/product');
        exit();
    }

    /**
     * @throws Exception|\Exception
     */
    public function SortProduct($by, $order): void
    {
        if ($_POST['send']) {
            $product = new product();
            $category = new category();
            $data = $product->SortBy($by, $order, $_POST['value']);
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['category'] = $category->getRow($data[$i]['category'])['libel'];
                $data[$i]['img'] = "data:image/jpg;charset=utf8;base64," . base64_encode($data[$i]['img']);
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            redirect('dashboard/P404');
        }
    }

    public function users(): void
    {
        $users = new users();
        $data['users'] = $users->getAll();
        for ($i = 0; $i < count($data['users']); $i++) {
            $imgdata = $data['users'][$i]['img'];
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
            if ($mime_type != 'text/plain') {
                $data['users'][$i]['img'] = "data:{$mime_type};charset=utf8;base64," . base64_encode($data['users'][$i]['img']) . '"';
            } else {
                $data['users'][$i]['img'] = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data['users'][$i]['img']))) . '"';
            }
        }
        view::load('dashboard/users', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    #[NoReturn] public function editUsers($id): void
    {
        $flag = true;
        $users = new users();
        $history = new history();
        if ($users->getRow($id)) {
            if ($users->getRow($id)['is_admin']) {
                if ($users->setClient($id)) {
                    notif::add('user edited successfully');
                    if ($id == $_SESSION['user']['id_u']) {
                        $log = new logoutController();
                        $log->index();
                    }
                } else {
                    $flag = false;
                    notif::add('error in edited user', 'error');
                }
            } else {
                if ($users->setAdmin($id)) {
                    notif::add('user edited successfully');
                } else {
                    $flag = false;
                    notif::add('error in edited user', 'error');
                }
            }
            if ($flag) {
                $data = array(
                    'item' => $users->getRow($id)['firstName'] . ' ' . $users->getRow($id)['lastName'],
                    'users' => $_SESSION['user']['id_u'],
                    'action' => 'Edit',
                    'role' => 'user'
                );
                $history->insert($data);
            }
        } else {
            redirect('dashboard/P404');
            exit();
        }
        redirect('dashboard/users');
    }

    /**
     * @throws Exception|\Exception
     */
    public function index(): void
    {
        $data = [];
        $users = new users();
        $products = new product();
        $data['products'] = $products->getRecent();
        $data['users'] = $users->getRecent();
        $data['total'] = $products->getTotal();
        $data['max'] = $products->getMax();
        $data['min'] = $products->getMin();
        $data['avg'] = round($products->getavg(), 2);
        for ($i = 0; $i < count($data['users']); $i++) {
            $imgdata = $data['users'][$i]['img'];
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
            if ($mime_type != 'text/plain') {
                $data['users'][$i]['img'] = "data:{$mime_type};charset=utf8;base64," . base64_encode($data['users'][$i]['img']);
            } else {
                $data['users'][$i]['img'] = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data['users'][$i]['img'])));
            }
        }
        View::load('dashboard/home', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    #[NoReturn] public function deletUser($id): void
    {
        $users = new users();
        $history = new history();
        if ($users->getRow($id)) {
            if ($users->delete($id)) {
                $data = array(
                    'item' => $users->getRow($id)['firstName'] . ' ' . $users->getRow($id)['lastName'],
                    'users' => $_SESSION['user']['id_u'],
                    'action' => 'Delete',
                    'role' => 'user'
                );
                $history->insert($data);
                notif::add('product deleted successfully');
            } else {
                notif::add('error in deleted product', 'error');
            }
        } else {
            redirect('dashboard/P404');
            exit();
        }
        redirect('dashboard/users');
    }

    public function help(): void
    {
        if (isset($_POST['send'])) {
            $mail = new PHPMailer(true);
            $email = "ouharrioutman@gmail.com";
            echo "<div style='display: none;'>";
            {
                $flag = true;
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail->Username = 'atman.atharri@gmail.com';                     //SMTP username
                    $mail->Password = 'jbpdcdxbpzmsfmzn';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    //Recipients
                    $mail->setFrom('atman.atharri@gmail.com');
                    $mail->addAddress($email);
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'from ' . $_SESSION['user']['email_u'];
                    $mail->Body = $_POST['mail'];
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    $flag = false;
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            echo "</div>";
            if ($flag) {
                notif::add('We\'ve send a verification link on your email address.');
            } else {
                notif::add('We Dont send a verification link ! (Something wrong went).', 'error');
            }
        }
        view::load('dashboard/help');
    }

    /**
     * @throws MpdfException
     */
    public function receiptPdf(): void
    {
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 8,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);
        $prod = '';
        $products = new Product();
        $category = new Category();
        $date = date('Y-m-d');
        $productCnt = $products->getAll();
        $mail = $_SESSION['user']['email_u'];
        $user = $_SESSION['user']['firstName_u'] . ' ' . $_SESSION['user']['lastName_u'];
        for ($i = 0; $i < count($productCnt); $i++) {
            $productCnt[$i]['category'] = $category->getRow($productCnt[$i]['category'])['libel'];
            $prod .= <<<PRODUCT
            <tr>
                <td class="no" style="width: 5px;"></td>
                <td class="desc"><h3>{$productCnt[$i]['libel']}</h3></td>
                <td class="unit">{$productCnt[$i]['category']}</td>
                <td class="qty">{$productCnt[$i]['qnt']}</td>
                <td class="qty">{$productCnt[$i]['codeBar']}</td>
                <td class="qty">{$productCnt[$i]['expirationDate']}</td>
                <td class="total">{$productCnt[$i]['price']} DH</td>
            </tr>
            PRODUCT;
        }
        $stylesheet = file_get_contents(url('css/print.css'));
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $received = <<<HTML
        <html lang="en">
            <body style="padding: 20px">
                <header class="clearfix" style="margin-bottom: 15px;padding-bottom: 10px">
                    <div id="logo" style="float: left;text-align: left;padding-top: 20px">
                        <img src="https://cdn.discordapp.com/attachments/1026552757135605851/1067480189803708526/favicon_Cureco.png" width="50px" height="50px" alt="">
                    </div>
                    <div id="company" style="float: left;text-align: right">
                        <h2 class="name">
                            <span class="title text-3xl">
                                Cure
                                <span style="color: rgba(2,100,52,0.69) !important;">Co</span>
                            </span>
                        </h2>
                        <div>455 west Lb7er, SE-rver AZ 85004, MA</div>
                        <div>(+212) 6311-98914</div>
                        <div><a href="mailto:ouharrioutman@gmail.com">ouharrioutman@gmail.com</a></div>
                    </div>
                </header>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client">
                            <div class="to">INVOICE TO:</div>
                            <h2 class="name">{$user}</h2>
                            <div class="address">796 Silver Harbour, TX 79273, US</div>
                            <div class="email"><a href="mailto:ouharrioutman@gmail.com">{$mail}</a></div>
                        </div>
                        <div id="invoice">
                            <h1 style="color: rgb(123, 188, 209)">Print - 7678 -</h1>
                            <div class="date">Date of Invoice: {$date}</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no" style="width: 5px;"></th>
                            <th class="desc">LIBEL</th>
                            <th class="unit">CATEGORY</th>
                            <th class="qty">QUANTITY</th>
                            <th class="qty">CODEBAR</th>
                            <th class="qty">EXPIRATIONDATE</th>
                            <th class="total">Price</th>
                        </tr>
                        </thead>
                        <tbody> 
                            {$prod}
                        </tbody>    
                    </table>
                    <div id="thanks" style="padding-top: 20px">Thank you!</div>
                    <div id="notices">
                        <div>NOTICE:</div>
                        <div class="notice">
                            you can cancel your reservation provided that the date is less than the departure date of the cruise!.
                        </div>
                    </div>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </body>
        </html>
        HTML;
        $mpdf->WriteHTML($received, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output('product.pdf', 'D');
    }

    /**
     * @throws Exception|\Exception
     */
    public function history(): void
    {
        $history = new history();
        $data['history'] = $history->getAllHistory();
        for ($i = 0; $i < count($data['history']); $i++) {
            $imgdata = $data['history'][$i]['img'];
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
            if ($mime_type != 'text/plain') {
                $data['history'][$i]['img'] = "data:{$mime_type};charset=utf8;base64," . base64_encode($data['history'][$i]['img']) . '"';
            } else {
                $data['history'][$i]['img'] = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data['history'][$i]['img']))) . '"';
            }
        }
        View::load('dashboard/history', $data);
    }

    /**
     * @throws Exception|\Exception
     */
    public function sortHistory($by = '', $order = ''): void
    {
        if ($_POST['send']) {
            $history = new History();
            $data = $history->SortBy($by, $order, $_POST['value']);
            for ($i = 0; $i < count($data); $i++) {
                $imgdata = $data[$i]['img'];
                $f = finfo_open();
                $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
                if ($mime_type != 'text/plain') {
                    $data[$i]['img'] = "data:{$mime_type};charset=utf8;base64," . base64_encode($data[$i]['img']) . '"';
                } else {
                    $data[$i]['img'] = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data[$i]['img']))) . '"';
                }
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            redirect('dashboard/P404');
        }
    }

    /**
     * @throws Exception|\Exception
     */
    public function searchHistory(): void
    {
        if ($_POST['send']) {
            $key = $_POST['value'];
            $history = new History();
            $data = $history->search($key);
            for ($i = 0; $i < count($data); $i++) {
                $imgdata = $data[$i]['img'];
                $f = finfo_open();
                $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
                if ($mime_type != 'text/plain') {
                    $data[$i]['img'] = "data:{$mime_type};charset=utf8;base64," . base64_encode($data[$i]['img']) . '"';
                } else {
                    $data[$i]['img'] = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data[$i]['img']))) . '"';
                }
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            redirect('dashboard/P404');
        }
    }

    /**
     * @throws Exception|\Exception
     */
    public function search(): void
    {
        if ($_POST['send']) {
            $key = $_POST['value'];
            $product = new product();
            $category = new category();
            $data = $product->search($key);
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['category'] = $category->getRow($data[$i]['category'])['libel'];
                $data[$i]['img'] = "data:image/jpg;charset=utf8;base64," . base64_encode($data[$i]['img']);
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            redirect('404');
        }
    }

    public function __destruct()
    {
        redirect::admin();
    }
}