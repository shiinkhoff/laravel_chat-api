Berikut adalah dokumentasi API dengan format yang sesuai untuk aplikasi **Threads**:

---

# **Dokumentasi API: Threads**

Dokumentasi ini menjelaskan cara penggunaan API dari sistem pengelolaan **Threads**. API ini memiliki beberapa resource utama: **Threads**, **Messages**, dan **Users**.

## **Autentikasi**

Semua endpoint bersifat **public** (tidak menggunakan token autentikasi) pada versi awal API ini.

**Base URL**:

```
http://localhost:8000/api
```

---

## **1. Threads**

### **GET /threads**

**Deskripsi**: Menampilkan semua thread yang ada.

**Response (Success - 200 OK)**:

```json
[
  {
    "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
    "user_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
    "content": "Ini adalah thread pertama.",
    "created_at": "2025-05-12T08:00:00.000000Z",
    "updated_at": "2025-05-12T08:00:00.000000Z"
  }
]
```

### **GET /threads/{id}**

**Deskripsi**: Menampilkan detail thread berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID thread yang ingin dilihat.

**Response (Success - 200 OK)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "user_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "content": "Ini adalah thread pertama.",
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **POST /threads**

**Deskripsi**: Menambahkan thread baru.

**Body JSON**:

```json
{
  "user_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "content": "Ini adalah thread pertama dari Sintya."
}
```

**Response (Success - 201 Created)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "user_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "content": "Ini adalah thread pertama dari Sintya.",
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **PUT /threads/{id}**

**Deskripsi**: Mengupdate konten thread berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID thread yang ingin diperbarui.

**Body JSON**:

```json
{
  "content": "Ini adalah konten yang sudah diperbarui."
}
```

**Response (Success - 200 OK)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "user_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "content": "Ini adalah konten yang sudah diperbarui.",
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **DELETE /threads/{id}**

**Deskripsi**: Menghapus thread berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID thread yang ingin dihapus.

**Response (Success - 200 OK)**:

```json
{
  "message": "Thread deleted successfully"
}
```

---

## **2. Messages**

### **GET /messages**

**Deskripsi**: Menampilkan semua pesan dalam percakapan.

**Response (Success - 200 OK)**:

```json
[
  {
    "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
    "conversation_id": "1bdcb857-8ea6-41d8-9f20-f04ae39f9d12",
    "sender_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
    "message": "Halo Sintya!",
    "is_read": false,
    "created_at": "2025-05-12T08:00:00.000000Z",
    "updated_at": "2025-05-12T08:00:00.000000Z"
  }
]
```

### **GET /messages/{id}**

**Deskripsi**: Menampilkan detail pesan berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID pesan yang ingin dilihat.

**Response (Success - 200 OK)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "conversation_id": "1bdcb857-8ea6-41d8-9f20-f04ae39f9d12",
  "sender_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "message": "Halo Sintya!",
  "is_read": false,
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **POST /messages**

**Deskripsi**: Mengirim pesan baru dalam percakapan.

**Body JSON**:

```json
{
  "conversation_id": "1bdcb857-8ea6-41d8-9f20-f04ae39f9d12",
  "sender_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "message": "Halo Sintya!",
  "is_read": false
}
```

**Response (Success - 201 Created)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "conversation_id": "1bdcb857-8ea6-41d8-9f20-f04ae39f9d12",
  "sender_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "message": "Halo Sintya!",
  "is_read": false,
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **PUT /messages/{id}**

**Deskripsi**: Mengupdate pesan berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID pesan yang ingin diperbarui.

**Body JSON**:

```json
{
  "message": "Pesan yang sudah diperbarui",
  "is_read": true
}
```

**Response (Success - 200 OK)**:

```json
{
  "id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "conversation_id": "1bdcb857-8ea6-41d8-9f20-f04ae39f9d12",
  "sender_id": "496e82d7-a804-4224-9fbf-41ae275419e9",
  "message": "Pesan yang sudah diperbarui",
  "is_read": true,
  "created_at": "2025-05-12T08:00:00.000000Z",
  "updated_at": "2025-05-12T08:00:00.000000Z"
}
```

### **DELETE /messages/{id}**

**Deskripsi**: Menghapus pesan berdasarkan `id`.

**Path Parameters**:

* `id` (string, required): ID pesan yang ingin dihapus.

**Response (Success - 200 OK)**:

```json
{
  "message": "Message deleted successfully"
}
```
