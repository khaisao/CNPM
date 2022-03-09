<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../lib/session.php');
?>

<?php
/**
 * 
 */
class staff
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($data)
    {
        $fullname = $data['fullname'];  
        $email = $data['email'];
        $dob = $data['dob'];
        $address = $data['address'];
        $password=password_hash($data['password'],PASSWORD_DEFAULT);



        // Check image and move to upload folder
        //$file_name = $_FILES['fullname'];
        //$file_temp = $_FILES['tmp_fullname'];

        //$div = explode('.', $file_name);  
        //$file_ext = strtolower(end($div));
        //$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        //$uploaded_image = "uploads/" . $unique_image;
        
        //move_uploaded_file($file_temp, $uploaded_image);

        $query = "INSERT INTO users VALUES (NULL,'$email','$fullname','$dob','$password',2,1,'$address', 0,1)";
        $result = $this->db->insert($query);
        if ($result) {
            $alert = "<span class='success'>Nhân viên đã được thêm thành công</span>";
            return $alert;
        } else {
            $alert = $query;
            return $alert;
        }
    }

    public function getAllAdmin($page = 1, $total = 8)
    {
        if ($page <= 0) {
            $page = 1;
        }
        $tmp = ($page - 1) * $total;
        $query =
           "SELECT products.*, categories.name as cateName, users.fullName
			 FROM products INNER JOIN categories ON products.cateId = categories.id INNER JOIN users ON products.createdBy = users.id
			 order by products.id desc 
        limit $tmp,$total";
        $result = $this->db->select($query);
        return $result;
    }

    //public function getAll()
    //{
    //    $query =
    //        "SELECT products.*, categories.name as cateName
	//		 FROM products INNER JOIN categories ON products.cateId = categories.id INNER JOIN users ON products.createdBy = users.id
	//		 WHERE products.status = 1
    //         order by products.id desc ";
    //    $result = $this->db->select($query);
    //    return $result;
    //}

    public function getCountPaging($row = 8)
    {
        $query = "SELECT COUNT(*) FROM users";
        $mysqli_result = $this->db->select($query);
        if ($mysqli_result) {
            $totalrow = intval((mysqli_fetch_all($mysqli_result, MYSQLI_ASSOC)[0])['COUNT(*)']);
            $result = ceil($totalrow / $row);
            return $result;
        }
        return false;
    }

    //public function getCountPagingClient($cateId, $row = 8)
    //{
    //    $query = "SELECT COUNT(*) FROM products WHERE cateId = $cateId";
    //   $mysqli_result = $this->db->select($query);
    //    if ($mysqli_result) {
    //        $totalrow = intval((mysqli_fetch_all($mysqli_result, MYSQLI_ASSOC)[0])['COUNT(*)']);
    //        $result = ceil($totalrow / $row);
    //        return $result;
    //    }
    //    return false;
    //}

    //public function getFeaturedProducts()
    //{
    //    $query =
    //        "SELECT *
	//		 FROM products
	//		 WHERE products.status = 1
    //         order by products.soldCount DESC
    //         LIMIT 8";
    //    $result = $this->db->select($query);
    //    return $result;
    //}

    //public function getProductsByCateId($page = 1, $cateId, $total = 8)
    //{
    //    if ($page <= 0) {
    //        $page = 1;
    //     }
    //    $tmp = ($page - 1) * $total;
    //    $query =
    //        "SELECT *
	//		 FROM products
	//		 WHERE status = 1 AND cateId = $cateId
    //         LIMIT $tmp,$total";
    //    $mysqli_result = $this->db->select($query);
    //    if ($mysqli_result) {
    //        $result = mysqli_fetch_all($mysqli_result, MYSQLI_ASSOC);
    //        return $result;
    //    }
    //    return false;
    //}
    public function getStaffbyId($id)
    {
        $query = "SELECT * FROM users where id = '$id' ";
        $mysqli_result = $this->db->select($query);
        if ($mysqli_result) {
            $result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
            return $result;
        }
        return false;
    }
    public function update($data, $files)
    {
        $fullname = $data['fullname'];  
        $dob = $data['dob'];
        $email = $data['email'];
        $password = $data['password'];     
        $address = $data['address'];
       
        $query = "UPDATE users SET 
				fullname ='$fullname',
				dob = '$dob',
				email = '$email',
				password = '$password',
				address = '$address',
				WHERE id = " . $data['id'] . " ";
        
        
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Cập nhật sản phẩm thất bại</span>";
            return $alert;
        }
    }

    public function getUserbyIdAdmin($id)
    {
        $query = "SELECT * FROM users where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getUserbyId($id)    
    {
        $query = "SELECT * FROM users where id = '$id' AND status = 1";
        $mysqli_result = $this->db->select($query);
        if ($mysqli_result) {
            $result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
            return $result;
        }
        return false;
    }

    public function block($id)
    {
        $query = "UPDATE users SET status = 0 where id = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function active($id)
    {
        $query = "UPDATE users SET status = 1 where id = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>