<?php

    namespace App\Filters;

    trait UserFilter{

        public function apply($collection, $request)
        {
            foreach($request->all() as $key => $value){
                if($request->has($key) &&  method_exists(__TRAIT__, $key)){
                    $methodName = $key;
                    $collection = $this->$methodName($collection, $request);
                }
            }
            return $collection;
        }

        public function statusCode($collection, $request)
        {
            if($request->statusCode == 'authorised'){
                $statusCode = 1;
            }elseif($request->statusCode == 'decline'){
                $statusCode = 2;
            }elseif($request->statusCode == 'refunded'){
                $statusCode = 3;
            }

            $collection = $collection->filter(function ($value, $key)use($statusCode) {
                return
                    (isset($value['statusCode']) && $value['statusCode'] == $statusCode) ||
                    (isset($value['status']) && $value['status'] == $statusCode*100);
            });

            return $collection;
        }

        public function currency($collection, $request)
        {
            $collection = $collection->filter(function ($value, $key)use($request) {
                return
                    (isset($value['currency']) && $value['currency'] == $request->currency) ||
                    (isset($value['Currency']) && $value['Currency'] == $request->currency);
            });
            return $collection;
        }

        public function balanceMax($collection, $request)
        {
            $collection = $collection->filter(function ($value, $key)use($request) {
                $balanceMax = (int) $request->balanceMax;
                return
                    (isset($value['balance']) && $value['balance'] <= $balanceMax) ||
                    (isset($value['parentAmount']) && $value['parentAmount'] <= $balanceMax);
            });

            return $collection;
        }

        public function balanceMin($collection, $request)
        {
            $collection = $collection->filter(function ($value, $key)use($request) {
                return
                    (isset($value['balance']) && $value['balance'] >= $request->balanceMin) ||
                    (isset($value['parentAmount']) && $value['parentAmount'] >= $request->balanceMin);
            });

            return $collection;
        }
    }
