<?php
require_once "Database.php";


class order
{
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAllOrders() {
        $query = "
           SELECT o.order_id,CONCAT(u.user_first_name,' ' ,u.user_last_name) as user_name,c.coupon_name as order_coupon,c.coupon_discount as order_discount, o.order_date ,o.order_total, o.order_status
            from orders o
            JOIN users u on u.user_id=o.user_id
            JOIN coupons c on c.coupon_id=o.coupon_id
            ORDER BY o.order_id
";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function viewOrderDetails($orderId)
    {
       try {
    $query = "SELECT p.product_name as product_name ,oi.quantity as product_quantity ,p.product_price as price,(p.product_price * oi.quantity) as total
    FROM order_items oi
    JOIN products p on oi.product_id= p.product_id
    where oi.orders_id =:order_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    $stmt->execute();

   
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    
    echo "Error: " . $e->getMessage();
    return false;  
}

    }

    public function getTotalSales() {
        $query = "SELECT SUM(order_total) AS total_sales
                  FROM orders               
                WHERE order_status IN ('Delivered', 'Pending')"; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_sales'] ? (float)$result['total_sales'] : 0; 
    }

    public function getOrderCount() {
        $query = "SELECT COUNT(order_id) AS total_orders FROM orders";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_orders'] ? (int)$result['total_orders'] : 0; 
    }

    public function getMonthlySales() {
        $query = "
            SELECT 
                DATE_FORMAT(order_date, '%Y-%m') AS month, 
                SUM(order_total) AS total_sales 
            FROM orders 
            GROUP BY month 
            ORDER BY month
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $monthlySales = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $monthlySales[] = [
                'month' => $row['month'],
                'total_sales' => (float)$row['total_sales'],
            ];
        }
        return $monthlySales;
    }
    






}


?>