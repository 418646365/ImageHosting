<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>实时疫情图</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/418646365/ImageHosting/cov/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/418646365/ImageHosting/cov/world.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/418646365/ImageHosting/cov/china.js"></script>

    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?72373e67ad82598385e9c651b4d0aca6";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <style>
        body {
            height: 800px;
            overflow: hidden;
        }

        *:focus {
            outline: none;
        }

        #main {
            max-width: px;
            margin: auto;
        }

        .info {
            display: flex;
            justify-content: space-between;
            text-align: center;
            line-height: 0.5;
            border-bottom: 1px solid #ebebeb;

        }

        .info > div {
            flex-grow: 1;
            margin: 0 4px;
            border-radius: 3px;
        }

        .info > div > p:first-child {
            font-size: 12px;
        }

        .title {
            text-align: center;
        }

        .copyright {
            font-size: 10px;
            text-align: right;
            color: #909399;
        }

        .copyright a {
            text-decoration: none;
        }

        .copyright a:hover, a:active, a:visited, a:link, a:focus {
            color: #909399;
        }

        .map {
            position: relative;
            height: 400px;
        }

        #worldmap {
            height: 380px;
        }

        .copyright {
            position: relative;
            width: 100%;
        }

        .copyright, .map {
            top: -65px;
        }

        .hide {
            display: none;
        }

        #worldmap {
            width: 100%;
        }

        .button {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            height: 28px;
            padding: 0 15px;
            font-size: 14px;
            border-radius: 4px;
            transition: color .2s linear, background-color .2s linear, border .2s linear, box-shadow .2s linear;
            color: #515a6e;
            background-color: #fff;
            border-color: #dcdee2;
        }

        .btn-active {
            color: #fff;
            background-color: #2d8cf0;
            border-color: #2d8cf0;
        }

        .tab {
            margin-top: 5px;
            text-align: center;
        }
    </style>
    </head>

<body>
<div>
    <div class="title">2020新冠实时疫情图</div>
    <div class="tab">
        <button onclick="showcn(this)" id="btn-cn" class="button btn-active">中国</button>
        <button onclick="showworld(this)" id="btn-world" class="button">全球</button>
    </div>
    <div class="info" id="cninfo">
        <div>
            <p>现存确诊</p>
            <p style="color: rgb(247, 76, 49);">113</p>
        </div>
        <div>
            <p>境外输入</p>
            <p style="color: rgb(247, 130, 7);">1786</p>
        </div>
        <div>
            <p>死亡</p>
            <p style="color: rgb(93, 112, 146);">4645</p>
        </div>
        <div>
            <p>治愈</p>
            <p style="color: rgb(40, 183, 163);">79883</p>
        </div>
    </div>

    <div class="info" id="worldinfo">

        <div>
            <p>现存确诊</p>
            <p style="color: rgb(247, 76, 49);">3584340</p>
        </div>
        <div>
            <p>累计确诊</p>
            <p style="color: rgb(247, 130, 7);">7095599</p>
        </div>

        <div>
            <p>累计死亡</p>
            <p style="color: rgb(93, 112, 146);">405176</p>
        </div>
    </div>
</div>
<div id="cnmap" class="map"></div>
<div id="worldmap" class="map"></div>
<div class="copyright"><a target="_blank" href="https://www.ghpym.com/2020cnyqt.html">调用地图</a></div>
<script type="text/javascript">
    var dom = document.getElementById("cnmap");
    var myChart = echarts.init(dom, null, {renderer: 'svg'});
    const cnoption = {
        bottom: '10px',
        tooltip: {
            show: true,
            trigger: 'item'
        },
        dataRange: {
            x: 'center',
            orient: 'horizontal',
            min: 0,
            max: 20000,
            text: ['高', '低'], // 文本，默认为数值文本
            splitNumber: 0,
            splitList: [
            	 {start: 100000, end: 9999999},
                {start: 1000, end: 99999},
                {start: 100, end: 1000},
                {start: 50, end: 100}, {start: 10, end: 50},
                {start: 1, end: 10},
                {start: 0, end: 0},
            ],
            inRange: {
                color: ['#fff', '#fff5c9', '#FDEBCF', '#F59E83', '#F59E83', '#CB2A2F', '#e6ac53', '#70161D','#380a0e']
            }
        },
        series: [
            {

                label: {

                    normal: {
                        fontFamily: 'Microsoft YaHei',
                        fontSize: 9,
                        show: true,

                    },
                    emphasis: {
                        show: false
                    }
                },
                name: '现存确诊',
                type: 'map',
                mapType: 'china',
                zoom: 1,
                itemStyle: {
                    normal: {
                        borderWidth: .5,//区域边框宽度
                        borderColor: '#B6B6B6',//区域边框颜色
                        areaColor: "#ffefd5",//区域颜色

                    },
                },
                data: JSON.parse('[{"name":"\u9999\u6e2f","value":53},{"name":"\u56db\u5ddd","value":21},{"name":"\u5e7f\u4e1c","value":9},{"name":"\u4e0a\u6d77","value":6},{"name":"\u5185\u8499\u53e4","value":6},{"name":"\u53f0\u6e7e","value":5},{"name":"\u5c71\u4e1c","value":4},{"name":"\u9655\u897f","value":3},{"name":"\u798f\u5efa","value":2},{"name":"\u5929\u6d25","value":2},{"name":"\u6d77\u5357","value":2},{"name":"\u5317\u4eac","value":1},{"name":"\u6e56\u5317","value":0},{"name":"\u6cb3\u5357","value":0},{"name":"\u6d59\u6c5f","value":0},{"name":"\u6e56\u5357","value":0},{"name":"\u5b89\u5fbd","value":0},{"name":"\u9ed1\u9f99\u6c5f","value":0},{"name":"\u6c5f\u897f","value":0},{"name":"\u6c5f\u82cf","value":0},{"name":"\u91cd\u5e86","value":0},{"name":"\u6cb3\u5317","value":0},{"name":"\u5e7f\u897f","value":0},{"name":"\u5c71\u897f","value":0},{"name":"\u4e91\u5357","value":0},{"name":"\u5409\u6797","value":0},{"name":"\u8fbd\u5b81","value":0},{"name":"\u8d35\u5dde","value":0},{"name":"\u7518\u8083","value":0},{"name":"\u65b0\u7586","value":0},{"name":"\u5b81\u590f","value":0},{"name":"\u6fb3\u95e8","value":0},{"name":"\u9752\u6d77","value":0},{"name":"\u897f\u85cf","value":0}]'),
            },
        ],
        animation: false,
    };
    myChart.setOption(cnoption, true);


    var worldmapdom = document.getElementById("worldmap");
    var worldChart = echarts.init(worldmapdom, null, {renderer: 'svg'});
    const worldoption = {
        bottom: '10px',
        tooltip: {
            show: true,
            trigger: 'item',
            formatter: function (val) {
                return val.data.provinceName + '<br>' + '现存确诊: ' + val.data.value
            }
        },
        dataRange: {
            x: 'center',
            orient: 'horizontal',
            min: 0,
            max: 20000,
            text: ['高', '低'], // 文本，默认为数值文本
            splitNumber: 0,
            splitList: [
            	 {start: 1000000, end: 9999999},
                {start: 10000, end: 999999},
                {start: 1000, end: 10000},
                {start: 99, end: 999},
                {start: 10, end: 99},
                {start: 0, end: 9},
            ],
            inRange: {
                color: ['#FAEBD2', '#D56355', '#BB3937','#CB2A2F', '#772526','#380a0e']
            }
        },
        series: [
            {

                label: {

                    normal: {
                        fontFamily: 'Microsoft YaHei',
                        fontSize: 9,
                        show: false
                    },
                    emphasis: {
                        show: false
                    }
                },
                name: '现存确诊',
                type: 'map',
                mapType: 'world',
                zoom: 0.8,
                itemStyle: {
                    normal: {label: {show: true, color: '#333'}, borderWidth: 0},
                },
                data: JSON.parse('[{"name":"United States","value":1343530,"provinceName":"\u7f8e\u56fd"},{"name":"Brazil","value":377985,"provinceName":"\u5df4\u897f"},{"name":"United Kingdom","value":247718,"provinceName":"\u82f1\u56fd"},{"name":"Russia","value":236714,"provinceName":"\u4fc4\u7f57\u65af"},{"name":"India","value":129813,"provinceName":"\u5370\u5ea6"},{"name":"Peru","value":105069,"provinceName":"\u79d8\u9c81"},{"name":"Chile","value":95530,"provinceName":"\u667a\u5229"},{"name":"Pakistan","value":71127,"provinceName":"\u5df4\u57fa\u65af\u5766"},{"name":"Spain","value":64454,"provinceName":"\u897f\u73ed\u7259"},{"name":"Bangladesh","value":55364,"provinceName":"\u5b5f\u52a0\u62c9\u56fd"},{"name":"France","value":53789,"provinceName":"\u6cd5\u56fd"},{"name":"Sweden","value":36236,"provinceName":"\u745e\u5178"},{"name":"Ecuador","value":35736,"provinceName":"\u5384\u74dc\u591a\u5c14"},{"name":"Belgium","value":33503,"provinceName":"\u6bd4\u5229\u65f6"},{"name":"Canada","value":33220,"provinceName":"\u52a0\u62ff\u5927"},{"name":"Italy","value":32872,"provinceName":"\u610f\u5927\u5229"},{"name":"Saudi Arabia","value":31449,"provinceName":"\u6c99\u7279\u963f\u62c9\u4f2f"},{"name":"Netherlands","value":30090,"provinceName":"\u8377\u5170"},{"name":"Iran (Islamic Republic of)","value":29045,"provinceName":"\u4f0a\u6717"},{"name":"Egypt","value":25737,"provinceName":"\u57c3\u53ca"},{"name":"Belarus","value":25297,"provinceName":"\u767d\u4fc4\u7f57\u65af"},{"name":"Qatar","value":24248,"provinceName":"\u5361\u5854\u5c14"},{"name":"South Africa","value":22823,"provinceName":"\u5357\u975e"},{"name":"Turkey","value":22787,"provinceName":"\u571f\u8033\u5176"},{"name":"Colombia","value":22655,"provinceName":"\u54e5\u4f26\u6bd4\u4e9a"},{"name":"Indonesia","value":19739,"provinceName":"\u5370\u5ea6\u5c3c\u897f\u4e9a"},{"name":"Afghanistan","value":18460,"provinceName":"\u963f\u5bcc\u6c57"},{"name":"Mexico","value":17832,"provinceName":"\u58a8\u897f\u54e5"},{"name":"Philippines","value":17239,"provinceName":"\u83f2\u5f8b\u5bbe"},{"name":"United Arab Emirates","value":16881,"provinceName":"\u963f\u8054\u914b"},{"name":"Argentina","value":16839,"provinceName":"\u963f\u6839\u5ef7"},{"name":"Ukraine","value":14992,"provinceName":"\u4e4c\u514b\u5170"},{"name":"Oman","value":13963,"provinceName":"\u963f\u66fc"},{"name":"Singapore","value":13930,"provinceName":"\u65b0\u52a0\u5761"},{"name":"Poland","value":13181,"provinceName":"\u6ce2\u5170"},{"name":"Bolivia","value":13019,"provinceName":"\u73bb\u5229\u7ef4\u4e9a"},{"name":"Portugal","value":12405,"provinceName":"\u8461\u8404\u7259"},{"name":"Kuwait","value":10705,"provinceName":"\u79d1\u5a01\u7279"},{"name":"Armenia","value":9007,"provinceName":"\u4e9a\u7f8e\u5c3c\u4e9a"},{"name":"Nigeria","value":8893,"provinceName":"\u5c3c\u65e5\u5229\u4e9a"},{"name":"Iraq","value":8045,"provinceName":"\u4f0a\u62c9\u514b"},{"name":"Dominican Republic","value":7668,"provinceName":"\u591a\u7c73\u5c3c\u52a0"},{"name":"Kazakhstan","value":6975,"provinceName":"\u54c8\u8428\u514b\u65af\u5766"},{"name":"Guatemala","value":6803,"provinceName":"\u5371\u5730\u9a6c\u62c9"},{"name":"Ghana","value":6398,"provinceName":"\u52a0\u7eb3"},{"name":"Honduras","value":6069,"provinceName":"\u6d2a\u90fd\u62c9\u65af"},{"name":"Panama","value":5914,"provinceName":"\u5df4\u62ff\u9a6c"},{"name":"Germany","value":5632,"provinceName":"\u5fb7\u56fd"},{"name":"Bahrain","value":5096,"provinceName":"\u5df4\u6797"},{"name":"Puerto Rico","value":4904,"provinceName":"\u6ce2\u591a\u9ece\u5404"},{"name":"Romania","value":4494,"provinceName":"\u7f57\u9a6c\u5c3c\u4e9a"},{"name":"Republic of Moldova","value":4208,"provinceName":"\u6469\u5c14\u591a\u74e6"},{"name":"Sudan","value":3911,"provinceName":"\u82cf\u4e39"},{"name":"Cameroon","value":3630,"provinceName":"\u5580\u9ea6\u9686"},{"name":"Dem. Rep. Congo","value":3629,"provinceName":"\u521a\u679c\uff08\u91d1\uff09"},{"name":"Azerbaijan","value":3487,"provinceName":"\u963f\u585e\u62dc\u7586"},{"name":"The Republic of Haiti","value":3283,"provinceName":"\u6d77\u5730"},{"name":"Nepal","value":3260,"provinceName":"\u5c3c\u6cca\u5c14"},{"name":"The Republic of El Salvador","value":3049,"provinceName":"\u8428\u5c14\u74e6\u591a"},{"name":"Algeria","value":2707,"provinceName":"\u963f\u5c14\u53ca\u5229\u4e9a"},{"name":"Israel","value":2654,"provinceName":"\u4ee5\u8272\u5217"},{"name":"Czechia","value":2390,"provinceName":"\u6377\u514b"},{"name":"Venezuela","value":2355,"provinceName":"\u59d4\u5185\u745e\u62c9"},{"name":"Gabon","value":2288,"provinceName":"\u52a0\u84ec"},{"name":"The Republic of Djibouti","value":2158,"provinceName":"\u5409\u5e03\u63d0"},{"name":"Mayotte","value":2125,"provinceName":"\u9a6c\u7ea6\u7279"},{"name":"Tajikistan","value":2070,"provinceName":"\u5854\u5409\u514b\u65af\u5766"},{"name":"Kenya","value":2028,"provinceName":"\u80af\u5c3c\u4e9a"},{"name":"Ethiopia","value":1925,"provinceName":"\u57c3\u585e\u4fc4\u6bd4\u4e9a"},{"name":"Bulgaria","value":1919,"provinceName":"\u4fdd\u52a0\u5229\u4e9a"},{"name":"Cote d Ivoire","value":1912,"provinceName":"\u79d1\u7279\u8fea\u74e6"},{"name":"Japan","value":1898,"provinceName":"\u65e5\u672c"},{"name":"Somalia","value":1814,"provinceName":"\u7d22\u9a6c\u91cc"},{"name":"Central African Republic","value":1807,"provinceName":"\u4e2d\u975e\u5171\u548c\u56fd"},{"name":"Uzbekstan","value":1794,"provinceName":"\u4e4c\u5179\u522b\u514b\u65af\u5766"},{"name":"Denmark","value":1726,"provinceName":"\u4e39\u9ea6"},{"name":"Senegal","value":1655,"provinceName":"\u585e\u5185\u52a0\u5c14"},{"name":"Cuba","value":1592,"provinceName":"\u53e4\u5df4"},{"name":"South Sudan","value":1570,"provinceName":"\u5357\u82cf\u4e39"},{"name":"Malaysia","value":1538,"provinceName":"\u9a6c\u6765\u897f\u4e9a"},{"name":"North Macedonia","value":1424,"provinceName":"\u5317\u9a6c\u5176\u987f"},{"name":"Greece","value":1394,"provinceName":"\u5e0c\u814a"},{"name":"Costa Rica","value":1308,"provinceName":"\u54e5\u65af\u8fbe\u9ece\u52a0"},{"name":"Guinea","value":1275,"provinceName":"\u51e0\u5185\u4e9a"},{"name":"Austria","value":1266,"provinceName":"\u5965\u5730\u5229"},{"name":"Nicaragua","value":1263,"provinceName":"\u5c3c\u52a0\u62c9\u74dc"},{"name":"Guinea-Bissau","value":1224,"provinceName":"\u51e0\u5185\u4e9a\u6bd4\u7ecd"},{"name":"Hungary","value":1187,"provinceName":"\u5308\u7259\u5229"},{"name":"Kyrgyzstan","value":1051,"provinceName":"\u5409\u5c14\u5409\u65af\u65af\u5766"},{"name":"Korea","value":989,"provinceName":"\u97e9\u56fd"},{"name":"Paraguay","value":978,"provinceName":"\u5df4\u62c9\u572d"},{"name":"Mauritania","value":926,"provinceName":"\u6bdb\u91cc\u5854\u5c3c\u4e9a"},{"name":"Maldives","value":924,"provinceName":"\u9a6c\u5c14\u4ee3\u592b"},{"name":"Finland","value":901,"provinceName":"\u82ac\u5170"},{"name":"Eq.Guinea","value":866,"provinceName":"\u8d64\u9053\u51e0\u5185\u4e9a"},{"name":"Sri Lanka","value":856,"provinceName":"\u65af\u91cc\u5170\u5361"},{"name":"Madagascar","value":855,"provinceName":"\u9a6c\u8fbe\u52a0\u65af\u52a0"},{"name":"Ireland","value":829,"provinceName":"\u7231\u5c14\u5170"},{"name":"Chad","value":769,"provinceName":"\u4e4d\u5f97"},{"name":"Morocco","value":734,"provinceName":"\u6469\u6d1b\u54e5"},{"name":"French Guiana","value":727,"provinceName":"\u6cd5\u5c5e\u572d\u4e9a\u90a3"},{"name":"Uganda","value":696,"provinceName":"\u4e4c\u5e72\u8fbe"},{"name":"Serbia","value":687,"provinceName":"\u585e\u5c14\u7ef4\u4e9a"},{"name":"San Marino","value":651,"provinceName":"\u5723\u9a6c\u529b\u8bfa"},{"name":"Lithuania","value":600,"provinceName":"\u7acb\u9676\u5b9b"},{"name":"Latvia","value":598,"provinceName":"\u62c9\u8131\u7ef4\u4e9a"},{"name":"Estonia","value":596,"provinceName":"\u7231\u6c99\u5c3c\u4e9a"},{"name":"Jamaica","value":588,"provinceName":"\u7259\u4e70\u52a0"},{"name":"Switzerland","value":585,"provinceName":"\u745e\u58eb"},{"name":"Mali","value":561,"provinceName":"\u9a6c\u91cc"},{"name":"Albania","value":551,"provinceName":"\u963f\u5c14\u5df4\u5c3c\u4e9a"},{"name":"Lebanon","value":543,"provinceName":"\u9ece\u5df4\u5ae9"},{"name":"Bosnia and Herzegovina","value":534,"provinceName":"\u6ce2\u9ed1"},{"name":"Congo","value":482,"provinceName":"\u521a\u679c\uff08\u5e03\uff09"},{"name":"R\u00e9union","value":480,"provinceName":"\u7559\u5c3c\u65fa"},{"name":"S\u00e3o Tom\u00e9 and Pr\u00edncipe","value":464,"provinceName":"\u5723\u591a\u7f8e\u548c\u666e\u6797\u897f\u6bd4"},{"name":"Australia","value":457,"provinceName":"\u6fb3\u5927\u5229\u4e9a"},{"name":"Cyprus","value":440,"provinceName":"\u585e\u6d66\u8def\u65af"},{"name":"Malawi","value":384,"provinceName":"\u9a6c\u62c9\u7ef4"},{"name":"Togo","value":377,"provinceName":"\u591a\u54e5"},{"name":"The Republic of Yemen","value":375,"provinceName":"\u4e5f\u95e8\u5171\u548c\u56fd"},{"name":"Sierra Leone","value":354,"provinceName":"\u585e\u62c9\u5229\u6602"},{"name":"Andorra","value":329,"provinceName":"\u5b89\u9053\u5c14"},{"name":"Tanzania","value":321,"provinceName":"\u5766\u6851\u5c3c\u4e9a"},{"name":"Mozambique","value":315,"provinceName":"\u83ab\u6851\u6bd4\u514b"},{"name":"Isle of Man","value":312,"provinceName":"\u9a6c\u6069\u5c9b"},{"name":"Norway","value":309,"provinceName":"\u632a\u5a01"},{"name":"Cabo Verde","value":296,"provinceName":"\u4f5b\u5f97\u89d2"},{"name":"Jersey","value":281,"provinceName":"\u6cfd\u897f\u5c9b"},{"name":"Benin","value":273,"provinceName":"\u8d1d\u5b81"},{"name":"occupied Palestinian territory","value":270,"provinceName":"\u5df4\u52d2\u65af\u5766"},{"name":"Libya","value":270,"provinceName":"\u5229\u6bd4\u4e9a"},{"name":"Zimbabwe","value":264,"provinceName":"\u6d25\u5df4\u5e03\u97e6"},{"name":"Liberia","value":255,"provinceName":"\u5229\u6bd4\u91cc\u4e9a"},{"name":"Malta","value":254,"provinceName":"\u9a6c\u8033\u4ed6"},{"name":"Jordan","value":251,"provinceName":"\u7ea6\u65e6"},{"name":"Guernsey","value":239,"provinceName":"\u6839\u897f\u5c9b"},{"name":"The Republic of Zambia","value":202,"provinceName":"\u8d5e\u6bd4\u4e9a\u5171\u548c\u56fd"},{"name":"Martinique","value":188,"provinceName":"\u9a6c\u63d0\u5c3c\u514b"},{"name":"Faroe Islands","value":187,"provinceName":"\u6cd5\u7f57\u7fa4\u5c9b"},{"name":"Burkina Faso","value":182,"provinceName":"\u5e03\u57fa\u7eb3\u6cd5\u7d22"},{"name":"Gibraltar","value":175,"provinceName":"\u76f4\u5e03\u7f57\u9640"},{"name":"Niger","value":174,"provinceName":"\u5c3c\u65e5\u5c14"},{"name":"Georgia","value":171,"provinceName":"\u683c\u9c81\u5409\u4e9a"},{"name":"Mongolia","value":170,"provinceName":"\u8499\u53e4"},{"name":"Guam","value":166,"provinceName":"\u5173\u5c9b"},{"name":"Cayman Islands","value":162,"provinceName":"\u5f00\u66fc\u7fa4\u5c9b"},{"name":"Rwanda","value":152,"provinceName":"\u5362\u65fa\u8fbe"},{"name":"Guadeloupe","value":150,"provinceName":"\u74dc\u5fb7\u7f57\u666e\u5c9b"},{"name":"Luxembourg","value":141,"provinceName":"\u5362\u68ee\u5821"},{"name":"Swaziland","value":136,"provinceName":"\u65af\u5a01\u58eb\u5170"},{"name":"Slovakia","value":134,"provinceName":"\u65af\u6d1b\u4f10\u514b"},{"name":"Bermuda","value":132,"provinceName":"\u767e\u6155\u5927"},{"name":"International conveyance (Diamond Princess)","value":125,"provinceName":"\u94bb\u77f3\u516c\u4e3b\u53f7\u90ae\u8f6e"},{"name":"Uruguay","value":124,"provinceName":"\u4e4c\u62c9\u572d"},{"name":"Suriname","value":120,"provinceName":"\u82cf\u91cc\u5357"},{"name":"Croatia","value":116,"provinceName":"\u514b\u7f57\u5730\u4e9a"},{"name":"Guyana","value":115,"provinceName":"\u572d\u4e9a\u90a3"},{"name":"China","value":113,"provinceName":"\u4e2d\u56fd"},{"name":"Trinidad & Tobago","value":109,"provinceName":"\u7279\u7acb\u5c3c\u8fbe\u548c\u591a\u5df4\u54e5"},{"name":"Myanmar","value":108,"provinceName":"\u7f05\u7538"},{"name":"Aruba","value":98,"provinceName":"\u963f\u9c81\u5df4"},{"name":"Syrian\u00a0ArabRepublic","value":97,"provinceName":"\u53d9\u5229\u4e9a"},{"name":"Union des Comores","value":95,"provinceName":"\u79d1\u6469\u7f57"},{"name":"Monaco","value":93,"provinceName":"\u6469\u7eb3\u54e5"},{"name":"Bahamas","value":92,"provinceName":"\u5df4\u54c8\u9a6c"},{"name":"Thailand","value":90,"provinceName":"\u6cf0\u56fd"},{"name":"French Polynesia","value":89,"provinceName":"\u6cd5\u5c5e\u6ce2\u5229\u5c3c\u897f\u4e9a"},{"name":"Barbados","value":85,"provinceName":"\u5df4\u5df4\u591a\u65af"},{"name":"The Republic of Burundi","value":78,"provinceName":"\u5e03\u9686\u8fea\u5171\u548c\u56fd"},{"name":"Tunisia","value":74,"provinceName":"\u7a81\u5c3c\u65af"},{"name":"Angola","value":71,"provinceName":"\u5b89\u54e5\u62c9"},{"name":"Slovenia","value":66,"provinceName":"\u65af\u6d1b\u6587\u5c3c\u4e9a"},{"name":"Vietnam","value":65,"provinceName":"\u8d8a\u5357"},{"name":"United States Virgin Islands","value":65,"provinceName":"\u7f8e\u5c5e\u7ef4\u5c14\u4eac\u7fa4\u5c9b"},{"name":"Sint Maarten","value":63,"provinceName":"\u8377\u5c5e\u5723\u9a6c\u4e01"},{"name":"Bhutan","value":59,"provinceName":"\u4e0d\u4e39"},{"name":"Iceland","value":42,"provinceName":"\u51b0\u5c9b"},{"name":"Botswana","value":41,"provinceName":"\u535a\u8328\u74e6\u7eb3"},{"name":"Saint Martin","value":38,"provinceName":"\u5723\u9a6c\u4e01\u5c9b"},{"name":"Namibia","value":28,"provinceName":"\u7eb3\u7c73\u6bd4\u4e9a"},{"name":"Liechtenstein","value":27,"provinceName":"\u5217\u652f\u6566\u58eb\u767b"},{"name":"Saint Vincent and the Grenadines","value":27,"provinceName":"\u5723\u6587\u68ee\u7279\u548c\u683c\u6797\u7eb3\u4e01\u65af"},{"name":"Northern Mariana Islands (Commonwealth of the)","value":26,"provinceName":"\u5317\u9a6c\u91cc\u4e9a\u7eb3\u7fa4\u5c9b\u8054\u90a6"},{"name":"Gambia","value":25,"provinceName":"\u5188\u6bd4\u4e9a"},{"name":"Tinor-Leste","value":24,"provinceName":"\u4e1c\u5e1d\u6c76"},{"name":"Grenada","value":23,"provinceName":"\u683c\u6797\u90a3\u8fbe"},{"name":"Antigua & Barbuda","value":22,"provinceName":"\u5b89\u63d0\u74dc\u548c\u5df4\u5e03\u8fbe"},{"name":"Cura\u00e7ao","value":20,"provinceName":"\u5e93\u62c9\u7d22\u5c9b"},{"name":"New Caledonia","value":20,"provinceName":"\u65b0\u5580\u91cc\u591a\u5c3c\u4e9a"},{"name":"Saint Lucia","value":19,"provinceName":"\u5723\u5362\u897f\u4e9a"},{"name":"Laos","value":19,"provinceName":"\u8001\u631d"},{"name":"The Republic of Fiji","value":18,"provinceName":"\u6590\u6d4e"},{"name":"Belize","value":17,"provinceName":"\u4f2f\u5229\u5179"},{"name":"Dominica","value":16,"provinceName":"\u591a\u7c73\u5c3c\u514b"},{"name":"Saint Kitts and Nevis","value":15,"provinceName":"\u5723\u5176\u8328\u548c\u5c3c\u7ef4\u65af"},{"name":"Greenland","value":13,"provinceName":"\u683c\u9675\u5170"},{"name":"Falkland Islands","value":13,"provinceName":"\u798f\u514b\u5170\u7fa4\u5c9b"},{"name":"Holy See","value":12,"provinceName":"\u68b5\u8482\u5188"},{"name":"Turks & Caicos\u00a0Islands","value":11,"provinceName":"\u7279\u514b\u65af\u548c\u51ef\u79d1\u65af\u7fa4\u5c9b"},{"name":"Seychelles","value":11,"provinceName":"\u585e\u820c\u5c14"},{"name":"Montserrat","value":10,"provinceName":"\u8499\u7279\u585e\u62c9\u7279"},{"name":"Brunei Darussalam","value":8,"provinceName":"\u6587\u83b1"},{"name":"Papua New Guinea","value":8,"provinceName":"\u5df4\u5e03\u4e9a\u65b0\u51e0\u5185\u4e9a"},{"name":"VirginIslands,British","value":7,"provinceName":"\u82f1\u5c5e\u7ef4\u5c14\u4eac\u7fa4\u5c9b"},{"name":"Bonaire, Sint Eustatius and Saba","value":7,"provinceName":"\u8377\u5170\u52a0\u52d2\u6bd4\u5730\u533a"},{"name":"Saint Barthelemy","value":6,"provinceName":"\u5723\u5df4\u6cf0\u52d2\u7c73\u5c9b"},{"name":"Mauritius","value":5,"provinceName":"\u6bdb\u91cc\u6c42\u65af"},{"name":"Cambodia","value":4,"provinceName":"\u67ec\u57d4\u5be8"},{"name":"Lesotho","value":4,"provinceName":"\u83b1\u7d22\u6258"},{"name":"Anguilla","value":3,"provinceName":"\u5b89\u572d\u62c9"},{"name":"Eritrea","value":2,"provinceName":"\u5384\u7acb\u7279\u91cc\u4e9a"},{"name":"Saint Pierre and Miquelon","value":1,"provinceName":"\u5723\u76ae\u57c3\u5c14\u548c\u5bc6\u514b\u9686\u7fa4\u5c9b"},{"name":"Montenegro","value":0,"provinceName":"\u9ed1\u5c71"},{"name":"New Zealand","value":-215,"provinceName":"\u65b0\u897f\u5170"}]'),
            },
        ],
        animation: false,
    };
    worldChart.setOption(worldoption, true);
    worldChart.resize();

    worldmap = document.getElementById("worldmap");
    cnmap = document.getElementById("cnmap");
    cninfo = document.getElementById("cninfo");
    worldinfo = document.getElementById("worldinfo");
    btncn = document.getElementById('btn-cn');
    btnworld = document.getElementById('btn-world');



        cnmap.style.display = 'none';
    worldmap.style.display = 'block';
    cninfo.style.display = 'none';
    worldinfo.style.display = 'flex';
    btncn.className = 'button';
    btnworld.className = 'button btn-active';
    


    function showcn(e) {

        cnmap.style.display = 'block';
        worldmap.style.display = 'none';
        cninfo.style.display = 'flex';
        worldinfo.style.display = 'none';
        btncn.className = 'button btn-active';
        btnworld.className = 'button';
    }

    function showworld(e) {
        worldmap.style.display = 'block';
        cnmap.style.display = 'none';
        cninfo.style.display = 'none';
        worldinfo.style.display = 'flex';
        btncn.className = 'button';
        btnworld.className = 'button btn-active';
    }
</script>
</body>
</html>