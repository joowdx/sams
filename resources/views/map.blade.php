@extends('layouts.app')

@section('styles')
<style>
    svg path {
        fill: #303030;
    }
    .cls{
        font-weight: 300;
        font-family: Calibri;
        font-size: 41.667px;
        fill: #fff;
    }

    .cls1{
        font-weight: 300;
        font-family: Calibri;
        font-size: 30px;
        fill: #fff;
    }
    #offices, #faculty, #lic, #mrc, #opl {
        fill: #1a1a1a;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 3347 1878">
        <path id="lic" d="M2377,108l3,250h559l1-250H2377Z"/>
    <path id="faculty" d="M1759,761l2,468,318,1-3-469H1759Z"/>
    <path id="gym" d="M79,430l4,657,1005-1,3-659Z"/>
    <path id="offices" d="M1225,270l6,466,421-2-1-465Z"/>
    <path id="psych" d="M1464,1648v165.5l183.99,0.01,1.01-164.52Z"/>
    <path id="mbl" d="M1351.46,33l2.47,151,288.12-1V29.951Z"/>
    <path id="opl" d="M3081,674V838h187V674H3081Z"/>
    <path id="mrc" d="M3081,845l2,378,187,2-2-379Z"/>
    <path id="cl2" d="M1451,559.012V726l191.13-1.992V558Z"/>
    <path id="cl1" d="M1452.99,754l-0.32,167L1643,921.306,1642.33,753Z"/>
    <path id="b11" d="M1457.01,939.5l1,168.5,189-1.31-1.07-167.527Z"/>
    <path id="cl3" d="M1238,755V923l186-2-1-167Z"/>
    <path id="pe" d="M1236.34,940.014L1237,1109h187l-0.05-170Z"/>
    <path id="comeng" d="M961,1116l1,211,140-1V1114Z"/>
    <path id="avr" d="M1942,129l2.01,220.978,134.99-2.5L2077.01,129H1942Z"/>
    <path id="tm" d="M950.916,196.994l0.974,211.162,138.21-.953L1089.11,196Z"/>
    <path id="c17" d="M808,1114H949l-1.335,210.93L808,1324.67V1114Z"/>
    <path id="c16" d="M660,1114.65l-0.339,209.71,142,1.31L801,1114Z"/>
    <path id="c14" d="M365,1115H505l-2.335,210.82-136.171-.99Z"/>
    <path id="c13" d="M217,1114.79l141.119,0.03,0.983,210.31H217.352Z"/>
    <path id="btte" d="M76,1115.34l0.964,209.67,134.532,0.02,0.489-211.05Z"/>
    <path id="b8" d="M1462.32,1468.01l182.02-.68v166.69l-182.37-.68Z"/>
    <path id="b10" d="M1462.61,1120.71l0.66,166.3L1645,1288l-1-168.66Z"/>
    <path id="c15" d="M512.014,1115.66L511,1324.33l140.994,0.34L651.972,1115ZM2438,1713.01"/>
    <path id="b1" d="M1242,1647.01l0.59,167.99,181.22-.99,0.81-168.01Z"/>
    <path id="b2" d="M1239.62,1470l-0.52,170.5,182.6-.27L1422,1470H1239.62Z"/>
    <path id="d1" d="M2865.75,1013.09l-1,216.39,179.31,0.52-0.64-217.53Z"/>
    <path id="d2" d="M2683,1013v216.24l175.03,0.26,0.7-216.92Z"/>
    <path id="b9" d="M1462.66,1292l-0.34,170.01,181.68,0.61,1.67-170.61Z"/>
    <path id="d10" d="M2109,760V977l187.5-.738L2296.74,760H2109Z"/>
    <path id="d9" d="M2301.63,760.7l0.43,215.761,183.92,0V760.978Z"/>
    <path id="d8" d="M2491.75,760.557L2491,976.5l184.49,0L2675,760.982Z"/>
    <path id="a3" d="M2229.67,128.035L2232,349.472l134.33,1.191L2364.99,127Z"/>
    <path id="a4" d="M2088.31,129.03L2089.3,350.5l136.39-.168L2224.7,128Z"/>
    <path id="d6" d="M2865,762.1l0.01,214.913,179.05-.948-0.02-214.514Z"/>
    <path id="d7" d="M2680.99,762.105V976.493l177.45-.234,0.29-214.416Z"/>
    <path id="electrical" d="M1800,131l1,217,134-1-1-217Z"/>
    <path id="a11" d="M1221.62,30.985L1220.66,184h126.68l-2.96-153.966Z"/>
    <path id="aml" d="M993,32l2.013,151.991L1214,183V32H993Z"/>
    <path id="d3" d="M2491,1013.25l0.25,215.5,184.99,0.75,1.76-216.99Z"/>
    <path id="d4" d="M2301,1013v215.75l185-.01V1012.75Z"/>
    <path id="d5" d="M2109.47,1013.24l-0.9,215.76h186.68l0.26-216.01Z"/>
    <path id="b3" d="M1237.32,1296l0.98,168,181.35,1,0.21-169H1237.32Z"/>
    <path id="b4" d="M1236.67,1121l1.26,170.02,181.07-.72-0.98-168.3Z"/>
    <path id="c2" d="M799.246,194.409l1.98,212.762,137.528,0.985-0.079-214.018ZM1689,446"/>
    <path id="c3" d="M652.443,194.823l0.488,213.007,138.626,0.492-0.133-213.335Z"/>
    <path id="c4" d="M507.736,194.478V407.833l135.993,1.09-1-214.617Z"/>
    <path id="c5" d="M365.5,195.536l-0.954,212.758,135.909-.007L498.5,194.469Z"/>
    <path id="c6" d="M220,195.414l1.447,212.9,132.263-.621,1.562-212.606Z"/>
    <path id="c7" d="M75.5,195.5V407.779l136.849,0.369-1.412-213.226Z"/>

    <text id="c7_" class="cls1" x="88.879" y="245.999">C7</text>
    <text id="c6_" class="cls1" x="236" y="245.999">C6</text>
    <text id="c5_" class="cls1" x="384" y="245.999">C5</text>
    <text id="c4_" class="cls1" x="525" y="245.999">C4</text>
    <text id="c3_" class="cls1" x="670" y="245.999">C3</text>
    <text id="c2_" class="cls1" x="818" y="245.999">C2</text>
    <text id="electrical_" class="cls1" x="1814" y="170">Elec</text>
    <text id="tm_" class="cls1" x="965" y="235">TM</text>
    <text id="btte_" class="cls1" x="88.879" y="1164.999">BTTE</text>
    <text id="comeng_" class="cls1" x="975" y="1164.999">LAB</text>
    <text id="c13_" class="cls1" x="235" y="1164.999">C13</text>
    <text id="c14_" class="cls1" x="382" y="1164.999">C14</text>
    <text id="c15_" class="cls1" x="528" y="1164.999">C15</text>
    <text id="c16_" class="cls1" x="679" y="1164.999">C16</text>
    <text id="c17_" class="cls1" x="825" y="1164.999">C17</text>
    <text id="b4_" class="cls1" x="1251" y="1172">B4</text>
    <text id="b3_" class="cls1" x="1251" y="1345">B3</text>
    <text id="b2_" class="cls1" x="1251" y="1520">B2</text>
    <text id="b1_" class="cls1" x="1251" y="1695">B1</text>
    <text id="b10_" class="cls1" x="1480" y="1172">B10</text>
    <text id="b9_" class="cls1" x="1480" y="1345">B9</text>
    <text id="b8_" class="cls1" x="1480" y="1520">B8</text>
    <text id="psych_" class="cls1" x="1480" y="1685">PSYCH</text>

    <text id="cl1_" class="cls1" x="1480" y="805">CL1</text>
    <text id="cl2_" class="cls1" x="1480" y="610">CL2</text>
    <a href="">
        <text id="cl3_" class="cls1" x="1251" y="805">CL3</text>
    </a>
    <text id="b11_" class="cls1" x="1480" y="980">CHEMLAB</text>
    <text id="aml_" class="cls1" x="1010" y="80">AML</text>
    <text id="pe_" class="cls1" x="1251" y="980">PE</text>
    <text id="a11_" class="cls1" x="1235" y="80">A11</text>
    <text id="mbl_" class="cls1" x="1370" y="80">MBL</text>
    <text id="avr_" class="cls1" x="1955" y="175">AVR</text>
    <text id="a4_" class="cls1" x="2105" y="175">A4</text>
    <text id="a3_" class="cls1" x="2245" y="175">A3</text>
    <text id="d10_" class="cls1" x="2125" y="810">D10</text>
    <text id="d9_" class="cls1" x="2320" y="810">D9</text>
    <text id="d8_" class="cls1" x="2510" y="810">D8</text>
    <text id="d7_" class="cls1" x="2700" y="810">D7</text>
    <text id="d6_" class="cls1" x="2885" y="810">D6</text>
    <text id="d5_" class="cls1" x="2125" y="1062">D5</text>
    <text id="d4" class="cls1" x="2320" y="1062">D4</text>
    <text id="d3_" class="cls1" x="2510" y="1062">D3</text>
    <text id="d2_" class="cls1" x="2700" y="1062">D2</text>
    <text id="d1_" class="cls1" x="2885" y="1062">D1</text>
    <text id="opl_" class="cls1" x="3095" y="720">OPL</text>
    <text id="mrc_" class="cls1" x="3095" y="890">MRC</text>

    <text class="cls" x="118.879" y="310">C7</text>
    <text class="cls" x="260" y="310">C6</text>
    <text class="cls" x="408" y="310">C5</text>
    <text class="cls" x="550" y="310">C4</text>
    <text class="cls" x="695" y="310">C3</text>
    <text class="cls" x="845" y="310">C2</text>

    <text class="cls" x="1305" y="1222">B4</text>
    <text class="cls" x="1305" y="1390">B3</text>
    <text class="cls" x="1305" y="1567">B2</text>
    <text class="cls" x="1305" y="1740">B1</text>
    <text class="cls" x="1517" y="1222">B10</text>
    <text class="cls" x="1525" y="1390">B9</text>
    <text class="cls" x="1525" y="1567">B8</text>

    <text class="cls" x="253" y="1230">C13</text>
    <text class="cls" x="400" y="1230">C14</text>
    <text class="cls" x="546" y="1230">C15</text>
    <text class="cls" x="695" y="1230">C16</text>
    <text class="cls" x="845" y="1230">C17</text>

    <text class="cls" x="2165" y="880">D10</text>
    <text class="cls" x="2367" y="880">D9</text>
    <text class="cls" x="2555" y="880">D8</text>
    <text class="cls" x="2745" y="880">D7</text>
    <text class="cls" x="2928" y="880">D6</text>
    <text class="cls" x="2177" y="1130">D5</text>
    <text class="cls" x="2366" y="1130">D4</text>
    <text class="cls" x="2557" y="1130">D3</text>
    <text class="cls" x="2745" y="1130">D2</text>
    <text  class="cls" x="2927" y="1130">D1</text>
    <text class="cls" x="3135" y="770">OPL</text>
    <text class="cls" x="1060" y="120">AML</text>
    <text class="cls" x="1250" y="120">A11</text>
    <text class="cls" x="1450" y="120">MBL</text>
    <text class="cls" y="1220"><tspan style="font-size: 30px; " x="975">COMENG</tspan><tspan style="font-size: 30px;" x="1006" dy="40">LAB</tspan></text>
    <text class="cls" x="1297" y="850">CL3</text>
    <text class="cls" x="1515" y="850">CL1</text>
    <text class="cls" y="1030"><tspan style="font-size: 30px; " x="1315">PE</tspan><tspan style="font-size: 30px;" x="1290" dy="40">ROOM</tspan></text>
    <text class="cls1" y="1030"><tspan style="font-size: 30px; " x="1525">B11</tspan><tspan style="font-size: 30px;" x="1488" dy="40">CHEMLAB</tspan></text>
    <text class="cls1" y="240"><tspan style= "font-size: 30px" x="1837">ELEC</tspan><tspan style= "font-size: 30px" x="1842" dy="40">LAB</tspan></text>
    <text style="font-size: 50px;" class="cls1" x="525" y="760" >GYM</text>
    <text class="cls1" y="300"><tspan style="font-size: 30px;" x="998">TM</tspan><tspan style="font-size: 30px;" x="996" dy="40">LAB</tspan></text>
    <text class="cls1" y="1726"><tspan style="font-size: 30px; " x="1515">PSYCH</tspan><tspan style="font-size: 30px;" x="1527" dy="40">LAB</tspan></text>
    <text class="cls" x="1975" y="250">AVR</text>
    <text class="cls" x="2133" y="250">A4</text>
    <text class="cls" x="2273" y="250">A3</text>
    <text class="cls" x="1525" y="655">CL2</text>
    <text id="c7_" class="cls1" y="1220"><tspan style="font-size: 30px; " x="114">BTTE</tspan><tspan style="font-size: 30px;" x="120" dy="40">LAB</tspan></text>
    <text style="font-size: 50px;" class="cls1" x="1351" y="515">OFFICES</text>
    <text style="font-size: 50px" class="cls1" x="2610" y="245">LIC</text>
    <text style="font-size: 50px" class="cls1" x="1790" y="1010">FACULTY RM</text>
    </svg>
</div>
@endsection

@section('scripts')
<script>
    try {
        Echo.private('logs').listen('NewScannedLog', function(e) {
            try {
                $('#' + e.log.from_by.name.toLowerCase()).css('fill', 'red')
                $('#' + e.log.from_by.name.toLowerCase() + '_').text('asdas')
            }
            catch(error) {

            }

        })
    }
    catch (error) {
        // location.reload()
    }
</script>
@endsection
