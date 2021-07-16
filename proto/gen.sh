mkdir examples/php/ -p
protoc \
  --php_out=examples/php \
  --grpc_out=examples/php \
  --plugin=protoc-gen-grpc=/usr/local/Cellar/grpc/1.38.1/bin/grpc_php_plugin \
  ./google/protobuf/any.proto ./nacos_grpc_service.proto
