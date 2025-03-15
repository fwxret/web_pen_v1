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
| **1** | **A03:2021 - Injection (SQLi)** | Thực hiện SQL Injection trong truy vấn đăng nhập. | `/login.php` | 🔴 Cao |
| **2** | **A07:2021 - Identification & Authentication Failures** | Cho phép xóa người dùng mà không xác thực quyền admin. | `/profile/updateEmail` | 🔴 Cao |
| **3** | **A08:2021 - Software and Data Integrity Failures (RCE)** | Cho phép tải lên file `.php` dẫn đến thực thi mã từ xa. | `/profile/uploadAvatar` | 🔴 Cao |
| **4** | **A06:2021 - Vulnerable and Outdated Components (Stored XSS)** | Chấp nhận input mà không lọc, gây **Stored XSS** trong bình luận blog. | `/blog_detail.php` | 🟠 Trung bình |
| **5** | **A05:2021 - Security Misconfiguration** | Cho phép truy cập file backup (`git_old`), lộ thông tin nhạy cảm. | `/backup/git_old` | 🟠 Trung bình |


---

## 4. Khai thác lỗ hổng  
_(Đang cập nhật...)_
