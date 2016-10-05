<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function get_wolontariusz_data($user_id){
    $user = get_user_by('id', $user_id);
    $wolontariusz_id = $user->wolontariusz_id;
    $data = array();
    $data['imie'] = get_user_meta($user_id,'imie',true);
    $data['nazwisko'] = get_user_meta($user_id,'nazwisko',true);
    $data['wolontariusz_id'] = $wolontariusz_id;
    return $data;
}
function get_wolontariusz_id($user_id){
    $user = get_user_by('id', $user_id);
    $wolontariusz_id = $user->wolontariusz_id;
    return $wolontariusz_id;
}
