# UDNM — Kho lưu trữ Theme & Plugins WordPress

Kho lưu trữ này chứa **theme** và **plugins** cho website WordPress.  
Mỗi khi đẩy (push) code lên nhánh `main`, GitHub Actions tự động(deploy).

---

## 🗂️ Cấu trúc thư mục
.
├── themes/
│   └── PhucNguyen_Theme/    # Theme WordPress chính
├── plugins/                 # Thư mục chứa các plugin
├── .github/
│   └── workflows/
│       └── main.yml         # Cấu hình GitHub Actions
├── .gitignore               # Các tệp/thư mục được bỏ qua
└── index.php                # Tệp index mặc định (nếu áp dụng)
text---

## ⚙️ Hướng dẫn sử dụng

### 1. Tải kho lưu trữ
```bash
git clone https://github.com/phucnguyen117/UDNM.git
cd UDNM
2. Cập nhật mã nguồn

Đặt tệp theme trong themes/PhucNguyen_Theme/.
Đặt tệp plugin trong plugins/.
Chỉnh sửa và kiểm tra trên máy cục bộ nếu cần.

3. GitHub Actions — Triển khai
Quy trình được định nghĩa trong .github/workflows/main.yml:

Tự động chạy khi có đẩy (push) lên nhánh main.
Chỉ triển khai các thư mục cần thiết: themes/PhucNguyen_Theme và plugins/.
Không triển khai các tệp/thư mục bị bỏ qua (ví dụ: .gitignore, .github/, cache/,... nếu được loại trừ trong quy trình).

🔐 Cấu hình Secrets (cho deploy)

Bạn cần thiết lập các GitHub Secrets để workflow có thể truy cập server:

Secret name	Mô tả
FTP_SERVER	Địa chỉ IP hoặc domain server
FTP_USERNAME	Tài khoản FTP / SFTP
FTP_PASSWORD	Mật khẩu tương ứng
REMOTE_DIR	Đường dẫn nơi deploy (ví dụ wp-content/)

