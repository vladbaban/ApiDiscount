<?PHP
namespace App\DiscountServices;


interface  IDiscount
{
	public function compute($orderInput,$description);
}

?>