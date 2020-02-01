package com.mobile.newsapp

open class Item (id:Int, title:String, des:String){
    var id: Int = 0
    var title: String? =null
    var des: String?=null

    init {
        this.id = id
        this.title=title
        this.des=des
    }

}