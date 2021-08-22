<footer>
    <div class="footerinfo">
        <h3>Follow us：</h3>
        <p>周一〜周日 11:00~22:00 </p>
        <p>804高雄市鼓山區</p>
        <p>07 - 0000000</p>
    </div>
</footer>
<style scoped>
footer{
    background:#787773	;
    width:100%;
    height:auto;
    /*垂直對齊、水平對齊都在容器的部分作處理*/
    display: flex; /*並排*/
    padding:25px 0px;
    justify-content: center;/*水平對齊align:分散排列*/
    flex-flow:wrap; 

}

footer>.footerinfo{
    flex:none;
    text-align: center;
    color:black;
    width:100%;
    height:0%;
    font-size:14px;
}
</style>