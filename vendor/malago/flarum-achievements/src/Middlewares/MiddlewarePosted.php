<?php

/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Illuminate\Support\Arr;


class MiddlewarePosted implements MiddlewareInterface {

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $actor = $request->getAttribute('actor');    

        $response = $handler->handle($request);
        
        $where = $request->getAttribute('routeName');
		
        if($actor->id != 0){
            $post = $this->toAssoc($actor->achievements->toArray());

           
            if($where === "posts.create" || $where === "posts.update" || $where === "users.avatar.upload" || $where === "login" || $where ==="default"){ //create post
                if(method_exists($response,"getPayload")){
                    $current = $this->toAssoc($actor->achievements->toArray());
                    $currentPayload=$response->getPayload();
                    $currentPayload["new_achievements"]=$actor["new_achievements"];
        
                    $response = $response->withPayload($currentPayload);
                }
            }else{
                 //app('log')->error(print_r("Where: ".$where,TRUE));
            }
        }
        return $response;
    }

    protected function toAssoc($arr)
    {
        $newArr = [];

        foreach ($arr as $model) {
            $newArr[$model['id']] = $model;
        }

        return $newArr;
    }
}