# Inventory System API v1

Base URL:
http://localhost:8000/api/v1

## Auth

POST /register
POST /login

## Categories

GET /categories
POST /categories
GET /categories/{id}
PUT /categories/{id}
DELETE /categories/{id}

## Items

GET /items
POST /items
GET /items/{id}
PUT /items/{id}
DELETE /items/{id}

# Filter Item Berdasarkan Kategori

## Endpoint

GET /api/v1/items?category_id={id}

## Contoh

GET /api/v1/items?category_id=1

## Response

```json
{
    "success": true,
    "data": [],
    "message": "Data item berhasil diambil"
}
```