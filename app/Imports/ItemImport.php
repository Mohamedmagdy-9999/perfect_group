<?php

namespace App\Imports;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\StoreItem;
use App\Models\Store;
use App\Models\Brand;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ItemImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */




    public function collection(Collection $rows)
    {
      foreach($rows as $row)
      {
       
      
                    
                        $brand = Brand::updateOrCreate([
                            'name_en' => $row['brand'],
                            'name_ar' => $row['brand'],
                            
                        ]);
                        
                        $br = Brand::where('name_en', $row['brand'])->first();
                        $item = new Item();
                        $item->name_en = $row['item_name'];
                        $item->name_ar = $row['item_name'];
                        $item->parcode = $row['item_code'];
                        $item->brand_id = $br->id;
                        $item->save();


                            $store = Store::where('name_en', $row['store'])->first();
                            

                                $storeitem = new StoreItem();
                                $storeitem->item_id = $item->id;
                                $storeitem->quantity = $row['quantity'];
                                $storeitem->store_id = $store->id;
                                $storeitem->purchasing_price = $row['purchasing_price'];
                                $storeitem->pay_price = $row['pay_price'];
                                $storeitem->purchasing_currency_id = 1;
                                $storeitem->pay_currency_id = 1;
                                $storeitem->brand_id = $br->id;
                                $storeitem->save();
                            
                               
        

                    

                    
           
        }
    }
}












         
           
          
               
         