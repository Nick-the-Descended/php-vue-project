<?php

namespace backend\classes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use backend\classes\ProductService;

class Router
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function route(ServerRequestInterface $request): ResponseInterface
    {
        $response = new \GuzzleHttp\Psr7\Response();
        $path = strtolower($request->getUri()->getPath());
        $method = $request->getMethod();

        // Add your routes here
        if ($path === '/products/getall' && $method === 'GET') {
            return $this->getAllProducts($request, $response);
        } elseif ($path === '/products/create' && $method === 'POST') {
            return $this->createProduct($request, $response);
        } elseif ($path === '/products/delete' && $method === 'DELETE') {
            return $this->deleteProducts($request, $response);
        } else {
            return $response->withStatus(404);
        }
    }

    // Implement your route methods here
    private function getAllProducts(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $products = $this->productService->getAllProducts();
        $body = json_encode(array_map(fn($x) => $x->serialize(), $products));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200)
            ->withBody(\GuzzleHttp\Psr7\Utils::streamFor($body));
    }

    private function createProduct(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = json_decode((string)$request->getBody(), true);
        $resultProduct = $this->productService->createProduct($data);

        if ($resultProduct) {
            $body = "Product created successfully.";
            $status = 200;
        } else {
            $body = "Failed to create product.";
            $status = 400;
        }

        return $response
            ->withStatus($status)
            ->withBody(\GuzzleHttp\Psr7\Utils::streamFor($body));
    }

    private function deleteProducts(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        if (isset($queryParams['skus'])) {
            $skus = json_decode($queryParams['skus'], true);

            if (is_array($skus)) {
                $result = $this->productService->deleteProducts($skus);

                if ($result > 0) {
                    return $response->withStatus(204);
                } else {
                    $body = "Failed to delete products.";
                    $status = 400;
                }
            } else {
                $body = "Invalid request. 'skus' parameter is not a valid JSON array.";
                $status = 400;
            }
        } else {
            $body = "Invalid request. 'skus' parameter is missing.";
            $status = 400;
        }

        return $response
            ->withStatus($status)
            ->withBody(\GuzzleHttp\Psr7\Utils::streamFor($body));
    }
}
