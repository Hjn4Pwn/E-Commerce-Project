#!/bin/bash

# Đợi Elasticsearch khởi động (khoảng 20 giây)
# sleep 20

# curl -X PUT "http://elasticsearch:9200/app_index" -H 'Content-Type: application/json' -d'
# {
#   "settings": {
#     "analysis": {
#       "tokenizer": {
#         "edge_ngram_tokenizer": {
#           "type": "edge_ngram",
#           "min_gram": 2,
#           "max_gram": 20,
#           "token_chars": [
#             "letter"
#           ]
#         }
#       },
#       "analyzer": {
#         "edge_ngram_analyzer": {
#           "type": "custom",
#           "tokenizer": "edge_ngram_tokenizer",
#           "filter": [
#             "lowercase"
#           ]
#         }
#       }
#     }
#   },
#   "mappings": {
#     "properties": {
#       "id": {
#         "type": "integer"
#       },
#       "name": {
#         "type": "text",
#         "analyzer": "edge_ngram_analyzer",
#         "search_analyzer": "standard"
#       },
#       "type": {
#         "type": "keyword"
#       }
#     }
#   }
# }
# '

# php artisan scout:import "App\Models\Flavor"
# php artisan scout:import "App\Models\Product"

php-fpm
