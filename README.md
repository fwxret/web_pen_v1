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

---

## 3. Thống kê lỗ hổng OWASP Top 10 (2021)  

| STT | Lỗ hổng | Mô tả | Vị trí | Mức độ |
|---|---|---|---|---|
| **1** | **A01:2021 - Broken Access Control** | Cho phép xóa user mà không kiểm tra quyền admin. | `/profile/deleteUser` | 🔴 Cao |
| **2** | **A03:2021 - Injection (SQLi)** | Thực hiện SQL Injection trong truy vấn đăng nhập. | `/login.php` | 🔴 Cao |
| **3** | **A07:2021 - Identification & Authentication Failures** | Lưu mật khẩu dưới dạng plaintext, không có bảo vệ đăng nhập. | `User.php` (Model) | 🟠 Trung bình |
| **4** | **A08:2021 - Software and Data Integrity Failures (RCE)** | Cho phép upload file `.php` dẫn đến thực thi mã từ xa (RCE). | `/profile/uploadAvatar` | 🔴 Cao |
| **5** | **A06:2021 - Vulnerable and Outdated Components (XSS)** | Chấp nhận input mà không lọc, gây **Stored XSS** trong bình luận blog. | `/blog_detail.php` | 🟠 Trung bình |

---

## 4. Khai thác lỗ hổng  
