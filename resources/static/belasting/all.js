function initReken() {
    try {
        document.getElementById("divVragen").style.display = "block";
    } catch (err) {
    }

    try {
        document.getElementById("divButtons").style.display = "block";
    } catch (err) {
    }

    if (uri.dir.toLowerCase().indexOf('\/rekenhulpen\/') != -1 || uri.dir.toLowerCase().indexOf('\/rekenhulpen_coi\/') != -1) {
        for (i = 0; i < document.forms.length; i++) {
            document.forms[i].reset();
        }
        var arrAllDIVs = document.getElementsByTagName("div");
        if (uri.dom == 'file:' || uri.dom.substr(0, 6) == "www-o." || uri.dom.substr(0, 9) == "douane-o." || uri.dom.substr(0, 8) == "tslgn-o." || uri.dom.substr(0, 9) == "localhost" || uri.dom.substr(0, 14) == "www-o-local.nl") {
            try {
                document.getElementById("divVersie").style.display = 'block';
            } catch (e) {
            }
            try {
                initVersie();
            } catch (e) {
            }
            for (i = 0; i <= arrAllDIVs.length - 1; i++) {
                if (arrAllDIVs[i].className == "clDebugHidden") {
                    try {
                        arrAllDIVs[i].className = "clDebug";
                    } catch (e) {
                    }
                }
            }
        } else {
            try {
                document.getElementById("divVersie").style.display = 'none';
            } catch (e) {
            }
            for (i = 0; i <= arrAllDIVs.length - 1; i++) {
                if (arrAllDIVs[i].className == "clDebug") {
                    try {
                        arrAllDIVs[i].className = "clDebugHidden";
                    } catch (e) {
                    }
                }
            }
        }
        toonVersie();
    }
}

function toonVersie() {
    var bToonteller = false;
    for (var i = 0; i < uri.args.length && bToonteller == false; i++) {
        if (uri.args[i] == "versie") {
            bToonteller = true;
            if (typeof sVersie !== "undefined") {
                alert("Versie: " + sVersie);
            } else if (typeof sTiVersie !== "undefined") {
                alert("Versie: " + sTiVersie);
            }
        }
    }
}

var prevFocus = '';

function findPos(obj, iWelke) {
    var curleft = 0;
    var curtop = 0;
    if (obj.offsetParent) {
        curleft = obj.offsetLeft;
        curtop = obj.offsetTop;
        while (obj = obj.offsetParent) {
            curleft += obj.offsetLeft;
            curtop += obj.offsetTop;
        }
    }
    if (iWelke == 1) {
        return [curleft]
    } else if (iWelke == 2) {
        return [curtop]
    } else {
        return [curleft, curtop];
    }
}

function GetDivProperties(sDiv) {
    var $doc = $(document);
    var $win = $(window);
    var $this = $("#" + sDiv);
    offset = $this.offset();
    iTop = offset.top - $doc.scrollTop();
    iBottom = $win.height() - iTop - $this.height();
    iLeft = offset.left - $doc.scrollLeft();
    iRight = $win.width() - iLeft - $this.width();
    oPos = {};
    oPos._left = iLeft;
    oPos._right = iRight;
    oPos._top = iTop;
    oPos._bottom = iBottom;
    oPos._width = $this.width();
    oPos._height = $this.height();
    return oPos
}

var oVraagteken = "";

function WisselVraagteken(oImage) {
    if (oVraagteken != "") {
        oVraagteken.src = "../images/bttn_help_normal.gif";
    }
    if (oImage != "") {
        oImage.src = "../images/bttn_help_ro.gif";
        oVraagteken = oImage;
    }
}

function toonDivs(strWelkeDiv, tmpSub, tmpFieldsetOff, tmpFieldsetOn, obj, bInlineAan, bOnlyHide) {
    var arrAllDIVs = document.getElementsByTagName("div");
    var i = 0;
    var tmpYoffset;
    for (i = 0; i <= arrAllDIVs.length - 1; i++) {
        if ((arrAllDIVs[i].id.substr(0, tmpSub.length) == tmpSub) && tmpSub != "") {
            if (bOnlyHide != true) {
                document.getElementById(arrAllDIVs[i].id).style.display = 'none';
            }
            document.getElementById(arrAllDIVs[i].id).style.visibility = 'hidden';
        }
    }
    if (tmpFieldsetOff != "") {
        if (bOnlyHide != true) {
            document.getElementById(tmpFieldsetOff).style.display = 'none';
        }
        document.getElementById(tmpFieldsetOff).style.visibility = 'hidden';
    }
    if (strWelkeDiv != "") {
        if (tmpFieldsetOn != "") {
            document.getElementById(tmpFieldsetOn).style.visibility = 'visible';
            document.getElementById(tmpFieldsetOn).style.display = 'block';
        }
        document.getElementById(strWelkeDiv).style.visibility = 'visible';
        document.getElementById(strWelkeDiv).style.display = 'block';
        if (bInlineAan == true) {
            document.getElementById(strWelkeDiv).style.visibility = 'visible';
            document.getElementById(strWelkeDiv).style.display = 'inline'
        }
        if (obj != undefined) {
            if (navigator.userAgent.indexOf("Firefox") != -1) {
                var topSpace = 220;
            } else {
                var topSpace = 220;
            }
            tmpYoffset = "" + (findPos(obj, 2) - topSpace) + "px";
            if (tmpSub == "divHelp" || tmpSub == "divTiHelp") {
                tmpYoffset = BerekenOffset(obj);
                document.getElementById(strWelkeDiv).style.marginTop = tmpYoffset;
            } else {
                document.getElementById(strWelkeDiv).style.top = tmpYoffset;
            }
        }
    }
}

function BerekenOffset(oThis) {

    iCorrectie = 7;
    iTop = $(oThis).offset().top;
    iTopMain = $(".size34").offset().top;
    if (navigator.userAgent.match("MSIE") && parseInt(navigator.userAgent.match("MSIE").substr(0, 1)) < 8) {
        iPaddingContentMain = 0;
    } else {
        iPaddingContentMain = parseInt($(".size14").css("padding-top"));
    }
    margin_top = iTop - (iTopMain + iPaddingContentMain + iCorrectie);
    return margin_top + "px";
}

function doHelp(strWelkeDiv, strX) {
    toonDivs(strWelkeDiv, "divHelp", "", "", strX);
    var helpBox = document.getElementById(strWelkeDiv);
    helpBox.querySelector('.clCloseText').focus();

    prevFocus = strWelkeDiv;

    if (document.getElementById("divHelpToetsingsinkomen")) {
        toonDivs(strWelkeDiv, "divTiHelp", "", "divHelpToetsingsinkomen", strX);
    }
    WisselVraagteken(strX);

    var $this = $("#" + strWelkeDiv);
    var iAanwijzerHoogte = 21;
    var oDiv = GetDivProperties(strWelkeDiv);
    var iOffset = 4;

    if (oDiv._bottom < 0) {
        iCurrentMarginTop = parseInt(ConvertToObject(strWelkeDiv).style.marginTop);
        iNewMarginTop = iCurrentMarginTop + oDiv._bottom - iOffset;
        iMarginVerschil = iCurrentMarginTop - iNewMarginTop;

        $this.css('marginTop', iNewMarginTop);
        $(".clHelpAanwijzer:visible").css('marginTop', iMarginVerschil);
        iVerschil = iMarginVerschil - ($this.height() - iAanwijzerHoogte);
        if (iVerschil > 0) {
            $this.css('marginTop', iNewMarginTop + iVerschil);
            $(".clHelpAanwijzer:visible").css('marginTop', iMarginVerschil - iVerschil);
        }
        if (iNewMarginTop < 0) {
            $this.css('marginTop', 0);
            $(".clHelpAanwijzer:visible").css('marginTop', iCurrentMarginTop);
        }
    } else {
        $(".clHelpAanwijzer:visible").css('marginTop', 0);
    }
}

function SluitHelp() {
    toonDivs('', 'divHelp', '', '', '', '', '')
    toonDivs('', 'divTiHelp', '', '', '', '', '');
    WisselVraagteken("");
    closeID = prevFocus.slice(7);
    var vraagID = document.getElementById('div' + closeID);
    $(vraagID).find('.clBtnInfo').focus();
}

document.addEventListener("DOMContentLoaded", function () {
    var helpboxen = document.querySelectorAll('.clBtnInfo');
    var link, onclickHtml = '';

    for (i = 0; i < helpboxen.length; i++) {
        if (helpboxen[i].hasAttribute('onclick')) {
            onclickHtml = helpboxen[i].getAttribute('onclick');
        }

        helpboxen[i].removeAttribute('class');
        helpboxen[i].removeAttribute('onclick');

        link = document.createElement('a');
        link.setAttribute('href', 'javascript:void(0)')
        link.className = "clBtnInfo";
        link.setAttribute('onclick', onclickHtml)

        $(link).insertBefore(helpboxen[i]);
        $(link).append(helpboxen[i]);
    }
});

function ZetInputUit(element, schakelaar) {
    var input = document.getElementById(element).getElementsByTagName("input");
    for (var i = 0; i < input.length; i++) {
        if (input[i].name.substr(0, 4) != "but_") {
            input[i].disabled = schakelaar;
        }
    }
}

function ZetSelectUit(element, schakelaar) {
    var input = document.getElementById(element).getElementsByTagName("select");
    for (var i = 0; i < input.length; i++) {
        input[i].disabled = schakelaar;
    }
}

if (arrAllResults == undefined) var arrAllResults = [];

if (arrAllQuestions == undefined) {
    var arrAllQuestions = [];
    arrAllQuestions[arrAllQuestions.length] = "Vraag1";
}

function ConvertToObject(elem) {
    return (typeof (sDiv) != "object") ? document.getElementById(elem) : sDiv;
}

function RegExpNumeric(strWaarde, strWelkVeld) {
    if (!isNummer(strWaarde)) {
        alert("Veld kan alleen cijfers bevatten");
        SetFocus(strWelkVeld);
    }
}

function RegExpAllNumeric(strWaarde, iPosities, strWelkVeld) {
    if (strWaarde.length != iPosities) {
        alert("Onvoldoende cijfers");
        SetFocus(strWelkVeld);
    }
    if (!isNummer(strWaarde)) {
        alert("Veld mag alleen cijfers bevatten");
        SetFocus(strWelkVeld);
    }
}

function RegExpAllNumeric(strWaarde, iPosities) {
    var bOk = true;
    if (strWaarde.length < iPosities) {
        alert("U heeft onvoldoende cijfers ingevuld.");
        bOk = false;
    } else if (!isNummer(strWaarde)) {
        alert("U kunt alleen cijfers invullen.");
        bOk = false;
    } else {
        checkRestant(strWaarde, iPosities);
    }
    return bOk;
}

function isNummer(strWaarde) {
    var objRegExp = /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
    return objRegExp.test(strWaarde);
}

function SetFocus(sInp) {
    if (!document.getElementById(sInp).disabled) {
        if (document.getElementById(sInp)) {
            setTimeout(function () {
                document.getElementById(sInp).focus()
            }, 10);
        } else if (document.getElementById("Berekening").sInp) {
            setTimeout(function () {
                eval("document.getElementById(\"Berekening\")." + sInp + ".focus()")
            }, 10);
        } else if (document.getElementById("frmBerekening").sInp) {
            setTimeout(function () {
                eval("document.getElementById(\"frmBerekening\")." + sInp + ".focus()")
            }, 10);
        }
    }
}

function SetFocus(sInp) {
    if (!document.getElementById(sInp).disabled) {
        if (document.getElementById(sInp)) {
            setTimeout(function () {
                document.getElementById(sInp).focus()
            }, 10);
        } else if (document.getElementById("frmBerekening").sInp) {
            setTimeout(function () {
                eval("getElementById(\"frmBerekening\")." + sInp + ".focus()")
            }, 10);
        } else if (document.getElementById("frmBerekening").sInp) {
            setTimeout(function () {
                eval("getElementById(\"frmBerekening\")." + sInp + ".focus()")
            }, 10);
        }
    }
}

function verwijderKarakters(sVal, bCent, bOokNul) {
    if (bCent) {
        sNewVal = sVal.replace(/[^\d,]/g, "");
        var iKomma = 0;
        var sTemp = "";
        for (var i = 0; i < sNewVal.length; i++) {
            if (sNewVal.substr(i, 1) != "," || (sNewVal.substr(i, 1) == "," && iKomma == 0)) {
                sTemp += sNewVal.substr(i, 1);
                if (sNewVal.substr(i, 1) == "," && iKomma == 0) {
                    iKomma++;
                }
            }
        }
        sNewVal = sTemp;

    } else {
        sNewVal = sVal.replace(/[^\d]/g, "");
        if (bOokNul && sVal == "0") {
            sNewVal = ""
        }
    }
    return sNewVal
}

var sVersie = "1.39.07.01";

function doKeuzeChange(strWaarde) {
    SluitHelp();
    document.getElementById("frmBerekening").reset();
    document.getElementById("restant").style.display = 'none';
    document.getElementById("genereer").style.display = 'none';
    document.getElementById("BtwLhGenereer").style.display = 'none';
    document.getElementById("fsInvoer1").style.display = 'none';
    document.getElementById("fsInvoer2").style.display = 'none';
    document.getElementById("fsBtwLhNaarKenmerk").style.display = 'none';
    document.getElementById("fsAangifteNaarKenmerk").style.display = 'none';
    document.getElementById("fsUitvoer").style.display = 'none';
    document.getElementById("divResultaat").style.display = 'none';
    if (strWaarde == "aanslagNAARkenmerk") {
        document.getElementById("fsInvoer1").style.display = 'block';
        document.getElementById("radioNaarKenmerk").checked = true;
    } else {
        document.getElementById("fsInvoer2").style.display = 'block';
        document.getElementById("radioNaarAanslag").checked = true;
    }
    return true;
}

function doKeuzeNaarKenmerkChange(oThis) {
    var sKeuze = oThis.value;
    document.getElementById("frmBerekening").reset();
    document.getElementById("radioNaarKenmerk").checked = true;
    if (oThis.value == "aangifteNAARkenmerk") {
        document.getElementById("radioAangifte").checked = true;
        $("#pMiddelCode").hide();
        $("#restant").hide();
        document.getElementById("fsBtwLhNaarKenmerk").style.display = 'none';
        document.getElementById("fsAangifteNaarKenmerk").style.display = 'block';
    } else if (oThis.value == "btwlhNAARkenmerk") {
        document.getElementById("radioBtwLh").checked = true;
        $("#BtwLhJaar").hide();
        $("#BtwLhFrequentie").hide();
        $('#BtwLhAangiftetijdvak').hide();
        vulBtwLhFrequentie();
        document.getElementById("fsAangifteNaarKenmerk").style.display = 'none';
        document.getElementById("fsBtwLhNaarKenmerk").style.display = 'block';
    }
    return true;
}

var sVorigBtwLh = "";

function CheckBtwLh(oThis, bAlert) {
    sBtwLh = oThis.value
    if ((sBtwLh != sVorigBtwLh && (sBtwLh != undefined || sBtwLh != "")) || bAlert == true) {
        sBtwLh = sBtwLh.toUpperCase();
        var sSofi = "";
        var sMiddel = "";
        var sVolgNr = "";
        var bValid = true;
        if (sBtwLh.indexOf("B") > -1) {
            sMiddel = "B";
        }
        if (sBtwLh.indexOf("L") > -1) {
            sMiddel += "L";
        }
        if (sMiddel.length == 1) {
            var iPos = sBtwLh.indexOf(sMiddel);
            sSofi = verwijderKarakters(sBtwLh.substr(0, iPos), false);
            if (iPos + 1 < sBtwLh.length) {
                sVolgNr = verwijderKarakters(sBtwLh.substr(iPos + 1), false);
                if (sVolgNr.length != 2 || isNaN(sVolgNr) == true) {
                    bValid = false;
                }
                if (sSofi.length >= 7 && sSofi.length <= 9) {
                    if (CheckSofiControleGetal(sSofi) == false) {
                        bAlert == true;
                        bValid = false;
                    } else {
                        while (sSofi.length != 9) {
                            sSofi = "0" + sSofi
                        }
                    }
                } else {
                    bValid = false;
                }
            } else {
                bValid = false;
            }
        } else {
            sSofi = verwijderKarakters(sBtwLh, false);
            bValid = false;
        }
        sVorigBtwLh = sSofi + sMiddel + sVolgNr;
        if (bValid == false) {
            $("#BtwLhJaar").hide();
            $('#BtwLhFrequentie').hide();
            $('#BtwLhAangiftetijdvak').hide();
            if (bAlert == true || sBtwLh.length == 12) {
                alert("U hebt een btw-/loonheffingennummer ingevuld dat ongeldig is. Vul dit nummer opnieuw in.");
            }
        } else {
            sSofinummer = sSofi;
            sMiddelCode = sMiddel;
            sSubnr = sVolgNr;
            vulBtwLhJaar();
            vulBtwLhFrequentie(sMiddel)

            $("#BtwLhJaar").show();
            $("#BtwLhFrequentie").hide();
            $('#BtwLhAangiftetijdvak').hide();
        }
    }
    BtwLhGenereer();
    return sVorigBtwLh;
}

function vulBtwLhFrequentie(sMiddel) {
    var i = 0;
    var aFreq = [];
    aFreq[i] = new Array(2);
    aFreq[i][0] = "";
    aFreq[i][1] = "Maak een keuze...";
    i++;
    if (sMiddel == "B") {
        aFreq[i] = new Array(2);
        aFreq[i][0] = "maand";
        aFreq[i][1] = "Maand";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "kalenderkwartaal";
        aFreq[i][1] = "Kalenderkwartaal";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "Boekjaarkwartaal_startmnd_2";
        aFreq[i][1] = "Boekjaarkwartaal dat aanvangt in 2e maand van een kalenderkwartaal";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "Boekjaarkwartaal_startmnd_3";
        aFreq[i][1] = "Boekjaarkwartaal dat aanvangt in 3e maand van een kalenderkwartaal";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "jaar";
        aFreq[i][1] = "Jaar";
        i++;
    } else if (sMiddel == "L") {
        aFreq[i] = new Array(2);
        aFreq[i][0] = "maand";
        aFreq[i][1] = "Maand";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "4_wekelijks";
        aFreq[i][1] = "4-wekelijks";
        i++;
        aFreq[i] = new Array(2);
        aFreq[i][0] = "halfjaar";
        aFreq[i][1] = "Halfjaar";
        i++
        aFreq[i] = new Array(2);
        aFreq[i][0] = "jaar";
        aFreq[i][1] = "Jaar";
        i++;
    }
    $('#selectBtwLhFrequentie').empty();
    for (var i = 0; i < aFreq.length; i++) {
        $('#selectBtwLhFrequentie').append($('<option/>', {
            value: aFreq[i][0], text: aFreq[i][1]
        }));
    }
}

function doBtwLhFrequentie(oThis) {
    document.getElementById("BtwLhGenereer").style.display = 'none';
    sTv = oThis.value;
    if (sTv != "") {
        var i = 0;
        var aTijdvak = [];
        aTijdvak[i] = new Array(2);
        aTijdvak[i][0] = "";
        aTijdvak[i][1] = "Maak een keuze...";
        i++;
        if (oThis.value == "maand") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "01";
            aTijdvak[i][1] = "januari";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "02";
            aTijdvak[i][1] = "februari";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "03";
            aTijdvak[i][1] = "maart";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "04";
            aTijdvak[i][1] = "april";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "05";
            aTijdvak[i][1] = "mei";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "06";
            aTijdvak[i][1] = "juni";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "07";
            aTijdvak[i][1] = "juli";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "08";
            aTijdvak[i][1] = "augustus";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "09";
            aTijdvak[i][1] = "september";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "10";
            aTijdvak[i][1] = "oktober";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "11";
            aTijdvak[i][1] = "november";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "12";
            aTijdvak[i][1] = "december";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle maanden";
            i++;
        } else if (oThis.value == "kalenderkwartaal") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "21";
            aTijdvak[i][1] = "januari t/m maart";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "24";
            aTijdvak[i][1] = "april t/m juni";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "27";
            aTijdvak[i][1] = "juli t/m september";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "30";
            aTijdvak[i][1] = "oktober t/m december";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle kalenderkwartalen";
            i++;
        } else if (oThis.value == "Boekjaarkwartaal_startmnd_2") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "22";
            aTijdvak[i][1] = "februari t/m april";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "25";
            aTijdvak[i][1] = "mei t/m juli";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "28";
            aTijdvak[i][1] = "augustus t/m oktober";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "31";
            aTijdvak[i][1] = "november t/m januari";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle boekjaarkwartalen startend in 2e maand van een kalenderkwartaal";
            i++;
        } else if (oThis.value == "Boekjaarkwartaal_startmnd_3") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "23";
            aTijdvak[i][1] = "maart t/m mei";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "26";
            aTijdvak[i][1] = "juni t/m augustus";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "29";
            aTijdvak[i][1] = "september t/m november";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "32";
            aTijdvak[i][1] = "december t/m februari";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle boekjaarkwartalen startend in 3e maand van een kalenderkwartaal";
            i++;
        } else if (oThis.value == "4_wekelijks") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "71";
            aTijdvak[i][1] = "Periode 1";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "72";
            aTijdvak[i][1] = "Periode 2";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "73";
            aTijdvak[i][1] = "Periode 3";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "74";
            aTijdvak[i][1] = "Periode 4";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "75";
            aTijdvak[i][1] = "Periode 5";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "76";
            aTijdvak[i][1] = "Periode 6";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "77";
            aTijdvak[i][1] = "Periode 7";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "78";
            aTijdvak[i][1] = "Periode 8";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "79";
            aTijdvak[i][1] = "Periode 9";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "80";
            aTijdvak[i][1] = "Periode 10";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "81";
            aTijdvak[i][1] = "Periode 11";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "82";
            aTijdvak[i][1] = "Periode 12";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "83";
            aTijdvak[i][1] = "Periode 13";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle 4-wekelijkse perioden";
            i++;
        } else if (oThis.value == "halfjaar") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "31";
            aTijdvak[i][1] = "1e half jaar";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "32";
            aTijdvak[i][1] = "2e half jaar";
            i++;
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "alle";
            aTijdvak[i][1] = "alle perioden";
            i++;
        } else if (oThis.value == "jaar") {
            aTijdvak[i] = new Array(2);
            aTijdvak[i][0] = "40";
            aTijdvak[i][1] = "januari t/m december";
            i++;
        }
        $('#selectBtwLhAangiftetijdvak').empty();
        for (var i = 0; i < aTijdvak.length; i++) {
            $('#selectBtwLhAangiftetijdvak').append($('<option/>', {
                value: aTijdvak[i][0], text: aTijdvak[i][1]
            }));
            $('#BtwLhAangiftetijdvak').show();
        }
    } else {
        $('#BtwLhAangiftetijdvak').hide();
        BtwLhGenereer();
        return false;
    }
    BtwLhGenereer()
    return true;
}

function doBtwLhJaar(oThis) {
    if (oThis.value != "") {
        $("#BtwLhFrequentie").show();
        if ($("#selectBtwLhFrequentie option:selected").val() != "") {
            $("#BtwLhAangiftetijdvak").show();
        }
        BtwLhGenereer()
        return true;
    } else {

        $("#BtwLhFrequentie").hide();
        $("#BtwLhAangiftetijdvak").hide();
        BtwLhGenereer();
        return false;
    }
}

function BtwLhGenereer() {
    sValid = "show";
    aFields = $("#fsBtwLhNaarKenmerk ").find('input[type=text],select');
    for (var i = 0; i < aFields.length && sValid == "show"; i++) {
        if (!$(aFields[i]).is(':visible')) {
            sValid = "hide";
        } else {
            if ($(aFields[i]).val() == "") {
                sValid = "hide";
            }
        }
    }
    eval('$("#BtwLhGenereer").' + sValid + '()');
}

function doBtwLhAangiftetijdvak(oThis) {
    BtwLhGenereer();
    if (oThis.value != "") {
        return true;
    } else {
        return false;
    }
}

function CheckMiddelcode(strMiddelcode) {
    verbergDivVraag();
    var strMiddelKeuze = "";
    toonDivs("", "divResult", "fsUitvoer", "");
    if (strMiddelcode == "") {
        document.getElementById("restant").style.display = "none";
        document.getElementById("genereer").style.display = "none";
        return false;
    }
    if ((strMiddelcode == "a") || (strMiddelcode == "b") || (strMiddelcode == "d") || (strMiddelcode == "e") || (strMiddelcode == "f") || (strMiddelcode == "l")) {
        strMiddelKeuze = "A";
    } else if ((strMiddelcode == "h") || (strMiddelcode == "n") || (strMiddelcode == "s")) {
        strMiddelKeuze = "H";
    } else if (strMiddelcode == "v") {
        strMiddelKeuze = "V";
    } else if (strMiddelcode == "y") {
        strMiddelKeuze = "Y";
    } else if (strMiddelcode == "m") {
        strMiddelKeuze = "M";
    } else if (strMiddelcode == "t") {
        strMiddelKeuze = "T";
    } else if (strMiddelcode == "w") {
        strMiddelKeuze = "W";
    } else if (strMiddelcode == "z") {
        strMiddelKeuze = "Z";
    }

    iInputs = document.getElementById("restant").getElementsByTagName("input");
    for (i = 0; i < iInputs.length; i++) {
        iInputs[i].value = "";
    }
    document.getElementById("restant").style.display = 'block';
    document.getElementById("frmBerekening").inputSofiMiddel.value = document.getElementById("frmBerekening").inputSofi.value + " . " + document.getElementById("frmBerekening").selectMiddelcode.value.toUpperCase() + " . ";
    document.getElementById(strMiddelKeuze).style.display = 'inline';

    document.getElementById("genereer").style.display = 'none';

    SetFocus(strMiddelKeuze);
}

function verbergDivVraag() {
    document.getElementById("A").style.display = "none";
    document.getElementById("H").style.display = "none";
    document.getElementById("Y").style.display = "none";
    document.getElementById("M").style.display = "none";
    document.getElementById("T").style.display = "none";
    document.getElementById("V").style.display = "none";
    document.getElementById("W").style.display = "none";
    document.getElementById("Z").style.display = "none";
}

function doUitvoerResult(strWelkeDiv) {
    ZetInputUit("fsKeuze", true);
    ZetInputUit("fsInvoer1", true);
    ZetInputUit("fsInvoer2", true);
    ZetInputUit("fsBtwLhNaarKenmerk", true);
    ZetInputUit("fsAangifteNaarKenmerk", true);
    ZetSelectUit("fsKeuze", true);
    ZetSelectUit("fsInvoer1", true);
    ZetSelectUit("fsInvoer2", true);
    ZetSelectUit("fsBtwLhNaarKenmerk", true);
    ZetSelectUit("fsAangifteNaarKenmerk", true);
    toonDivs("", "divHelp", "", "");
    toonDivs(strWelkeDiv, "divResult", "", "fsUitvoer");
    toonDivs("divResultaat", "", "", "fsUitvoer", "", "", "");
    document.getElementById("genereer").style.display = 'none';
    document.getElementById("BtwLhGenereer").style.display = 'none';

}

function doOpnieuw(strWelkVeld, strActie) {
    toonDivs("", "divResult", "fsUitvoer", "");
    ZetInputUit("fsKeuze", false);
    ZetInputUit("fsInvoer1", false);
    ZetInputUit("fsAangifteNaarKenmerk", false);
    ZetInputUit("fsBtwLhNaarKenmerk", false);
    ZetInputUit("fsInvoer2", false);
    ZetSelectUit("fsAangifteNaarKenmerk", false);
    ZetSelectUit("fsBtwLhNaarKenmerk", false);
    ZetSelectUit("fsInvoer2", false);

    document.getElementById("genereer").style.display = 'block';
    document.getElementById("BtwLhGenereer").style.display = 'block';
    if (strWelkVeld != "") {
        SetFocus(strWelkVeld);
    }
}

function vulBtwLhJaar() {
    var year = new Date().getFullYear();
    $('#selectBtwLhJaar').empty();
    $('#selectBtwLhJaar').append($('<option/>', {
        value: "", text: "Maak een keuze..."
    }))
    for (var i = year - 10; i < year + 10; i++) {
        var bSel = false;
        if (i == year) {

        }
        $('#selectBtwLhJaar').append($('<option/>', {
            value: i.toString().substr(3, 1), text: i
        }).attr('selected', bSel));
    }


}

function initVersie() {

    document.getElementById("divVersie").innerHTML = '<p>Versie: ' + sVersie + '</p>'
}

var arGewichten = [2, 4, 8, 5, 10, 9, 7, 3, 6, 1, 2, 4, 8, 5, 10];
var strHuidigJaarFull = ((new Date()).getFullYear()).toString();
var strHuidigJaar = strHuidigJaarFull.substr(strHuidigJaarFull.length - 1, 1);
var sSofinummer;
var sMiddelCode;
var sSubnr;

function Bereken(iWelkeBerekening) {
    SluitHelp();
    if (iWelkeBerekening == 0) {
        var strTemp = "";
        var strSofi = document.getElementById("frmBerekening").inputSofi.value;
        while (strSofi.length != 9) {
            strSofi = "0" + strSofi
        }
        var strMiddelcode = document.getElementById("frmBerekening").selectMiddelcode.value;
        var strUitvoer1 = "";
        var strBetalingskenmerk = "";

        if ((strMiddelcode == "a") || (strMiddelcode == "b") || (strMiddelcode == "d") || (strMiddelcode == "e") || (strMiddelcode == "f") || (strMiddelcode == "l")) {
            strBetalingskenmerk = strBetalingskenmerk + strSofi.substring(0, 8);
            var strSubnummer = document.getElementById("frmBerekening").A.value.substring(0, 2);
            var strJaar = document.getElementById("frmBerekening").A.value.substring(2, 3);
            var strTijdvak = document.getElementById("frmBerekening").A.value.substring(3, 5);
            var strTijdvak2 = document.getElementById("frmBerekening").A.value.substring(3);
            var strVolgbob = document.getElementById("frmBerekening").A.value.substring(5);
            if (strMiddelcode == "a") {
                strBetalingskenmerk = strBetalingskenmerk + "0"
            }
            if (strMiddelcode == "b") {
                strBetalingskenmerk = strBetalingskenmerk + "1"
            }
            if (strMiddelcode == "d") {
                strBetalingskenmerk = strBetalingskenmerk + "3"
            }
            if (strMiddelcode == "e") {
                strBetalingskenmerk = strBetalingskenmerk + "4"
            }
            if (strMiddelcode == "f") {
                strBetalingskenmerk = strBetalingskenmerk + "5"
            }
            if (strMiddelcode == "l") {
                strBetalingskenmerk = strBetalingskenmerk + "6"
            }
            strBetalingskenmerk = strBetalingskenmerk + strJaar + strSubnummer + strTijdvak + strVolgbob;
            strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strSubnummer + "." + strJaar + strTijdvak2;
        }
        if ((strMiddelcode == "h") || (strMiddelcode == "n") || (strMiddelcode == "s")) {
            strBetalingskenmerk = strBetalingskenmerk + strSofi.substring(0, 8);
            if (strMiddelcode == "h") {
                strBetalingskenmerk = strBetalingskenmerk + "70"
            }
            if (strMiddelcode == "n") {
                strBetalingskenmerk = strBetalingskenmerk + "73"
            }
            if (strMiddelcode == "s") {
                strBetalingskenmerk = strBetalingskenmerk + "72"
            }
            var strJaar = document.getElementById("frmBerekening").H.value.substring(0, 1);
            var strSoort = document.getElementById("frmBerekening").H.value.substring(1, 2);
            if (strJaar == "") {
                strJaar = "x"
            }
            if (strSoort == "") {
                strSoort = "x"
            }
            var strVolgnummer = BelastingjaarIs2011ofLater(strJaar) ? document.getElementById("frmBerekening").H.value.substring(2) : "00";
            strBetalingskenmerk = strBetalingskenmerk + strJaar + strSoort + "0" + strVolgnummer;
            var strVolgnummer = BelastingjaarIs2011ofLater(strJaar) ? "." + (document.getElementById("frmBerekening").H.value.substring(2)) : "";
            strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar + strSoort + strVolgnummer;
        }
        if (strMiddelcode == "v") {
            if (strSofi.substring(0, 2) == "00") {
                strBetalingskenmerk = stripString(strSofi, "0").substring(0, stripString(strSofi, "0").length - 1)
            }
            if (strSofi.substring(0, 1) == "8") {
                strBetalingskenmerk = strSofi.substring(2, 8)
            }
            var strJaar = document.getElementById("frmBerekening").V.value.substring(0, 1);
            var strSoort = document.getElementById("frmBerekening").V.value.substring(1, 2);
            if (strSofi.substring(0, 2) == "00") {
                strMiddel = "74"
            } else if (strSofi.substring(0, 2) == "80" || strSofi.substring(0, 2) == "81" || strSofi.substring(0, 2) == "82" || strSofi.substring(0, 2) == "83" || strSofi.substring(0, 2) == "84") {
                strMiddel = strSofi.substring(0, 2);
            } else if (strSofi.substring(0, 2) == "85") {
                strMiddel = "92";
            } else if (strSofi.substring(0, 2) == "86") {
                strMiddel = "93";
            } else if (strSofi.substring(0, 2) == "87") {
                strMiddel = "94";
            } else if (strSofi.substring(0, 2) == "88") {
                strMiddel = "95";
            } else if (strSofi.substring(0, 2) == "89") {
                strMiddel = "96";
            }

            var strTijdvak = document.getElementById("frmBerekening").V.value.substring(2);
            strBetalingskenmerk = strBetalingskenmerk + strJaar + strSoort + strMiddel + strTijdvak + "0";
            strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar + strSoort + "." + strTijdvak;
        }
        if (strMiddelcode == "t") {
            strBetalingskenmerk = strBetalingskenmerk + strSofi.substring(0, 8);
            strTemp = document.getElementById("frmBerekening").T.value;
            var strJaar2 = strTemp.substr(0, (strTemp.length) - 5);
            if (strTemp.length == 6) {
                strTemp = berekenDecennium(strTemp.substring(0, 1)) + strTemp;
            }
            var strJaar = strTemp.substring(1, 2);
            var strSoort = strTemp.substring(2, 3);
            var strVolgnummer = strTemp.substring(3, 6);
            var strVolgnummer2 = strTemp.substring(3);
            var strMiddelherkenning = "x";
            if (strTemp.substring(6) == "1") {
                var strMiddelherkenning = "23"
            }
            if (strTemp.substring(6) == "2") {
                var strMiddelherkenning = "24"
            }
            if (strTemp.substring(6) == "3") {
                var strMiddelherkenning = "25"
            }
            if (strTemp.substring(6) == "4") {
                var strMiddelherkenning = "26"
            }
            strBetalingskenmerk = strBetalingskenmerk + strMiddelherkenning + strJaar + strSoort + strVolgnummer;
            strUitvoer1 = MaakSofiOp(strSofi) + "." + strMiddelcode.toUpperCase() + "." + strJaar2 + "." + strSoort + strVolgnummer2;
        }
        if (strMiddelcode == "w") {
            strBetalingskenmerk = strBetalingskenmerk + strSofi.substring(0, 8);
            var strSlotcijfers = document.getElementById('frmBerekening').W.value;

            var strJaar = strSlotcijfers.charAt(0);

            var strSoort = strSlotcijfers.charAt(1);
            if ((strSoort == "1" || strSoort == "2" || strSoort == "3" || strSoort == "4" || strSoort == "5" || strSoort == "9") && BelastingjaarIs2011ofLater(strJaar)) {
                strSoort = "x";
            }

            var strVolgnummer = (strSlotcijfers.length == 5) ? strSlotcijfers.substring(2, 4) : "00";

            if (strSlotcijfers.length == 2) {
                strMiddelherkenning = "4";
            } else if (strSlotcijfers.length == 3) {
                strMiddelherkenning = strSlotcijfers.charAt(2);
            } else if (strSlotcijfers.length == 5) {
                strMiddelherkenning = strSlotcijfers.charAt(4);
            }
            if (strMiddelherkenning == "8" || strMiddelherkenning == "9") {
                strMiddelherkenning = "x"
            }
            strBetalingskenmerk = strBetalingskenmerk + "75" + strJaar + strSoort + strVolgnummer + strMiddelherkenning;

            strMiddelherkenning = (strSlotcijfers.length == 2) ? "" : ("." + strMiddelherkenning);
            strVolgnummer = (strSlotcijfers.length == 5) ? ("." + strVolgnummer) : "";
            strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar + strSoort + strVolgnummer + strMiddelherkenning;
        }

        if (strMiddelcode == "m") {
            var strSofinummer = strSofi.substring(0, 8);
            var strJaar = document.getElementById("frmBerekening").M.value.substring(0, 1);
            var strMiddelcodeNummer = ""
            var strVolgnummer = document.getElementById("frmBerekening").M.value.substring(1);
            if (strVolgnummer == "") {
                strVolgnummer = "0001"
            }


            if ((parseInt(strVolgnummer) >= 1 && parseInt(strVolgnummer) <= 9999) || (parseInt(strVolgnummer) >= 90001 && parseInt(strVolgnummer) <= 99999)) {
                if (parseInt(strVolgnummer) <= 9999) {
                    strMiddelcodeNummer = "78";
                } else {
                    strMiddelcodeNummer = "87";
                }
                if (strVolgnummer.length == 5) {
                    var strVolgnummerTemp = strVolgnummer
                }
                if (strVolgnummer.length == 4) {
                    var strVolgnummerTemp = "0" + strVolgnummer
                }
                if (strVolgnummer.length == 3) {
                    var strVolgnummerTemp = "00" + strVolgnummer
                }
                if (strVolgnummer.length == 2) {
                    var strVolgnummerTemp = "000" + strVolgnummer
                }
                if (strVolgnummer.length == 1) {
                    var strVolgnummerTemp = "0000" + strVolgnummer
                }
                strBetalingskenmerk = strSofinummer + strMiddelcodeNummer + strJaar + strVolgnummerTemp.substring(1);
                if (strVolgnummer == "0001") {
                    strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar;
                } else {
                    strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar + "." + strVolgnummer;
                }
            }
        }

        if (strMiddelcode == "y") {
            if (strSofi.substring(0, 1) != "9") {
                strBetalingskenmerk = strSofi.substring(0, 8)
                var strJaar = document.getElementById("frmBerekening").Y.value.substring(0, 1);
                var strVolgnummer1 = "";
                if (document.getElementById("frmBerekening").Y.value.length > 1) {
                    strVolgnummer1 = document.getElementById("frmBerekening").Y.value.substring(1)
                }
                if (parseInt(strVolgnummer1) <= 9999 || strVolgnummer1 == "") {
                    var strMiddel = "76"
                }
                if (parseInt(strVolgnummer1) > 9999) {
                    var strMiddel = "88"
                }
                if (strVolgnummer1.length == 0) {
                    var strVolgnummer = "0001"
                }
                if (strVolgnummer1.length == 1) {
                    var strVolgnummer = "000" + strVolgnummer1
                }
                if (strVolgnummer1.length == 2) {
                    var strVolgnummer = "00" + strVolgnummer1
                }
                if (strVolgnummer1.length == 3) {
                    var strVolgnummer = "0" + strVolgnummer1
                }
                if (strVolgnummer1.length == 4) {
                    var strVolgnummer = strVolgnummer1
                }
                if (strVolgnummer1.length == 5) {
                    var strVolgnummer = strVolgnummer1.substring(1)
                }
                strBetalingskenmerk = "" + strBetalingskenmerk + strMiddel + strJaar + strVolgnummer;
                strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + strJaar + "." + document.getElementById("frmBerekening").Y.value.substring(1);
            }
        }
        if (strMiddelcode == "z") {
            strBetalingskenmerk = strBetalingskenmerk + strSofi.substring(0, 8);
            var strJaar = document.getElementById("frmBerekening").Z.value.substring(0, 1);
            var strMiddelherkenning = "x";
            if ((document.getElementById("frmBerekening").Z.value.substring(5) == "1") || (document.getElementById("frmBerekening").Z.value.substring(5) == "2")) {
                var strMiddel = "97";
                var strJaar = document.getElementById("frmBerekening").Z.value.substring(0, 1);
                var strSoort = document.getElementById("frmBerekening").Z.value.substring(1, 2);
                var strVolgnummer = document.getElementById("frmBerekening").Z.value.substring(2, 4);
                var strMiddelherkenning = document.getElementById("frmBerekening").Z.value.substring(5);
                strBetalingskenmerk = strBetalingskenmerk + strMiddel + strJaar + strSoort + strVolgnummer + strMiddelherkenning;
                strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + document.getElementById("frmBerekening").Z.value.substring(0, 2) + "." + document.getElementById("frmBerekening").Z.value.substring(2);
            }
            if ((document.getElementById("frmBerekening").Z.value.substring(5) == "7") || (document.getElementById("frmBerekening").Z.value.substring(5) == "8")) {
                if (document.getElementById("frmBerekening").Z.value.substring(5) == "7") {
                    var strMiddel = "85"
                }

                if (document.getElementById("frmBerekening").Z.value.substring(5) == "8") {
                    var strMiddel = "86"
                }
                var strVolgnummer = document.getElementById("frmBerekening").Z.value.substring(1, 5);
                strBetalingskenmerk = strBetalingskenmerk + strMiddel + strJaar + strVolgnummer;
                strUitvoer1 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode.toUpperCase() + "." + document.getElementById("frmBerekening").Z.value.substring(0, 5) + "." + document.getElementById("frmBerekening").Z.value.substring(5);
            }
        }
        var iControlegetal = 0;
        for (i = 0; i <= 14; i++) {
            iControlegetal = iControlegetal + parseInt(strBetalingskenmerk.charAt(14 - i)) * arGewichten[i]
        }

        iControlegetal = 11 - (iControlegetal % 11);
        if (iControlegetal == 10) {
            iControlegetal = 1
        }
        if (iControlegetal == 11) {
            iControlegetal = 0
        }
        strTemp = iControlegetal + strBetalingskenmerk;
        if (strTemp.indexOf("NaN") > -1 || strTemp.length != 16) {

            doUitvoerResult("divResultGeenAanslagnummer");

        } else {

            strTemp = iControlegetal + strBetalingskenmerk;
            strUitvoer2 = strTemp.substring(0, 4) + " " + strTemp.substring(4, 8) + " " + strTemp.substring(8, 12) + " " + strTemp.substring(12);
            document.getElementById("spanAanslagnummer").innerHTML = "<h2>Aangifte-, aanslag- of beschikkingsnummer</h2><p>" + strUitvoer1 + "</p>";
            document.getElementById("spanBetalingsKenmerk").innerHTML = "<h2>Betalingskenmerk</h2><p>" + strUitvoer2 + "</p>";
            doUitvoerResult("divResult");
        }
    } else if (iWelkeBerekening == 1) {
        var strAlleInput = document.getElementById("frmBerekening").bkVeld0.value + document.getElementById("frmBerekening").bkVeld1.value + document.getElementById("frmBerekening").bkVeld2.value + document.getElementById("frmBerekening").bkVeld3.value;
        if (CheckBetalingskenmerk(strAlleInput) == true) {
            var strTemp = "";
            var strMiddelcode = "";
            var iTemp = 0;
            var strMiddelcode1 = document.getElementById("frmBerekening").bkVeld2.value.substring(1, 3);
            var strMiddelcode2 = document.getElementById("frmBerekening").bkVeld2.value.substring(1, 2);
            var strSofi = document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value + document.getElementById("frmBerekening").bkVeld2.value.substring(0, 1);


            if (strMiddelcode1 == "74") {
                strSofi = "00" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "80" || strMiddelcode1 == "81" || strMiddelcode1 == "82" || strMiddelcode1 == "83" || strMiddelcode1 == "84") {
                strSofi = strMiddelcode1 + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "92") {
                strSofi = "85" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "93") {
                strSofi = "86" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "94") {
                strSofi = "87" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "95") {
                strSofi = "88" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            } else if (strMiddelcode1 == "96") {
                strSofi = "89" + document.getElementById("frmBerekening").bkVeld0.value.substring(1) + document.getElementById("frmBerekening").bkVeld1.value.substring(0, 3)
            }


            for (i = 0; i <= 7; i++) {
                iTemp = iTemp + (parseInt(strSofi.substring(i, i + 1)) * (9 - i))
            }
            strSofi = strSofi + "" + iTemp % 11;

            if ((strMiddelcode2 == "0") || (strMiddelcode2 == "1") || (strMiddelcode2 == "3") || (strMiddelcode2 == "4") || (strMiddelcode2 == "5") || (strMiddelcode2 == "6")) {
                if (strMiddelcode2 == "0") {
                    strMiddelcode = "A"
                }

                if (strMiddelcode2 == "1") {
                    strMiddelcode = "B"
                }

                if (strMiddelcode2 == "3") {
                    strMiddelcode = "D"
                }

                if (strMiddelcode2 == "4") {
                    strMiddelcode = "E"
                }

                if (strMiddelcode2 == "5") {
                    strMiddelcode = "F"
                }

                if (strMiddelcode2 == "6") {
                    strMiddelcode = "L"
                }

            }
            if (strMiddelcode1 == "23" || strMiddelcode1 == "24" || strMiddelcode1 == "25" || strMiddelcode1 == "26") {
                strMiddelcode = "T"
            }
            if (strMiddelcode1 == "70") {
                strMiddelcode = "H"
            }

            if (strMiddelcode1 == "72") {
                strMiddelcode = "S"
            }

            if (strMiddelcode1 == "73") {
                strMiddelcode = "N"
            }

            if (strMiddelcode1 == "75") {
                strMiddelcode = "W"
            }

            if (strMiddelcode1 == "76") {
                strMiddelcode = "Y"
            }

            if (strMiddelcode1 == "78" || strMiddelcode1 == "87") {
                strMiddelcode = "M"
            }

            if (strMiddelcode1 == "76" || strMiddelcode1 == "88") {
                strMiddelcode = "Y"
            }

            if (strMiddelcode1 == "97" || strMiddelcode1 == "85" || strMiddelcode1 == "86") {
                strMiddelcode = "Z"
            }

            if (strMiddelcode1 == "74" || strMiddelcode1 == "80" || strMiddelcode1 == "81" || strMiddelcode1 == "82" || strMiddelcode1 == "83" || strMiddelcode1 == "84" || strMiddelcode1 == "92" || strMiddelcode1 == "93" || strMiddelcode1 == "94" || strMiddelcode1 == "95" || strMiddelcode1 == "96") {
                strMiddelcode = "V"
            }


            if ((strMiddelcode == "A") || (strMiddelcode == "B") || (strMiddelcode == "D") || (strMiddelcode == "E") || (strMiddelcode == "F") || (strMiddelcode == "L")) {
                var strSubnummer = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(2, 3);
                var strTijdvak = document.getElementById("frmBerekening").bkVeld3.value.substring(1, 3);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(3);
                var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strSubnummer + "." + strJaar + strTijdvak + strVolgnummer;
            }
            if ((strMiddelcode == "H") || (strMiddelcode == "N") || (strMiddelcode == "S")) {
                var strSubnummer = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                var strSoort = document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(1);
                if (!BelastingjaarIs2011ofLater(strJaar)) {
                    if (strVolgnummer == "000") {
                        strVolgnummer = "";
                    } else {
                        strMiddelcode = "";
                    }
                } else {
                    strVolgnummer = "." + strVolgnummer.substring(1);
                }
                var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strSoort + strVolgnummer;
            }
            if (strMiddelcode == "T") {
                var strSubnummer = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strJaar = berekenDecennium(document.getElementById("frmBerekening").bkVeld2.value.substring(3)) + document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                var strSoort = document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(1);
                if (strMiddelcode1 == "23") {
                    var strMiddelherkenning = "1"
                }
                if (strMiddelcode1 == "24") {
                    var strMiddelherkenning = "2"
                }
                if (strMiddelcode1 == "25") {
                    var strMiddelherkenning = "3"
                }
                if (strMiddelcode1 == "26") {
                    var strMiddelherkenning = "4"
                }
                var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + "." + strSoort + strVolgnummer + strMiddelherkenning;
            }

            if (strMiddelcode == "M") {

                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(0);
                if (strMiddelcode1 == "78") {
                    strVolgnummer = "0" + strVolgnummer
                }
                if (strMiddelcode1 == "87") {
                    strVolgnummer = "9" + strVolgnummer
                }
                if (strVolgnummer == "00001") {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar;
                } else {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + "." + stripString(strVolgnummer, "0");
                }
            }

            if (strMiddelcode == "V") {
                var strJaar = document.getElementById("frmBerekening").bkVeld1.value.substring(3);
                var strSoort = document.getElementById("frmBerekening").bkVeld2.value.substring(0, 1);
                var strTijdvak = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 3);
                var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strSoort + "." + strTijdvak;
            }

            if (strMiddelcode == "W") {
                var strSubnummer = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                var strSoort = document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(1, 3);
                if (!BelastingjaarIs2011ofLater(strJaar)) {
                    if (strVolgnummer == "00") {
                        strVolgnummer = "";
                    } else {
                        strMiddelcode = "";
                    }
                } else {
                    strVolgnummer = "." + strVolgnummer;
                }
                var strMiddelherkenning = document.getElementById("frmBerekening").bkVeld3.value.substring(3);
                if ((strMiddelherkenning == "4" || strMiddelherkenning == "5") && !(BelastingjaarIs2011ofLater(strJaar))) {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strSoort + strVolgnummer;
                } else {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strSoort + strVolgnummer + "." + strMiddelherkenning;
                }
            }
            if (strMiddelcode == "Y") {
                var strSubnummer = document.getElementById("frmBerekening").bkVeld2.value.substring(3) + document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(0);
                if (strMiddelcode1 == "76") {
                    strVolgnummer = "0" + strVolgnummer
                }
                if (strMiddelcode1 == "88") {
                    strVolgnummer = "9" + strVolgnummer
                }
                if (strVolgnummer == "00001") {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar;
                } else {
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + "." + stripString(strVolgnummer, "0");
                }
            }
            if (strMiddelcode == "Z") {
                var strJaar = document.getElementById("frmBerekening").bkVeld2.value.substring(3);
                if (strMiddelcode1 == "97") {
                    var strSoort = document.getElementById("frmBerekening").bkVeld3.value.substring(0, 1);
                    var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(1, 3);
                    var strMiddelherkenning = document.getElementById("frmBerekening").bkVeld3.value.substring(3);
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strSoort + "." + strVolgnummer + "0" + strMiddelherkenning;
                }
                if (strMiddelcode1 == "85") {
                    var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(0);
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strVolgnummer + "." + "7";
                }
                if (strMiddelcode1 == "86") {
                    var strVolgnummer = document.getElementById("frmBerekening").bkVeld3.value.substring(0);
                    var strUitvoer3 = MaakSofiOp(stripString(strSofi, "0")) + "." + strMiddelcode + "." + strJaar + strVolgnummer + "." + "8";
                }
            }
            if (strMiddelcode == "") {
                doUitvoerResult("divResultGeenAanslagnummer");
            } else {
                document.getElementById("spanAanslagnummer").innerHTML = "<h2>Aangifte-, aanslag- of beschikkingsnummer</h2><p>" + strUitvoer3 + "</p>";
                document.getElementById("spanBetalingsKenmerk").innerHTML = "";
                doUitvoerResult("divResult");
            }
        } else {
            alert("Betalingskenmerk onjuist");
        }
    } else if (iWelkeBerekening == 2) {

        if (sMiddelCode == "B") {
            sMidddelBetalingskenmerk = 1
        } else if (sMiddelCode == "L") {
            sMidddelBetalingskenmerk = 6
        }
        var aTijdvak = [];

        if (document.getElementById("selectBtwLhAangiftetijdvak").value == "alle") {
            $("#selectBtwLhAangiftetijdvak > option").each(function () {
                if ($(this).val() != "" && $(this).val() != "alle") {
                    var temp = $(this).text() + " " + $(this).val();
                    aTijdvak[aTijdvak.length] = new Array(2);
                    aTijdvak[aTijdvak.length - 1][0] = $(this).text();
                    aTijdvak[aTijdvak.length - 1][1] = $(this).val();

                }
            });
        } else {
            aTijdvak[aTijdvak.length] = new Array(2);
            aTijdvak[aTijdvak.length - 1][0] = $("#selectBtwLhAangiftetijdvak option:selected").text();
            aTijdvak[aTijdvak.length - 1][1] = $("#selectBtwLhAangiftetijdvak").val();
        }

        if (aTijdvak.length > 1) {
            var sHTML = '<table id="tblResultMeerdereTijdvakken"><caption>Overzicht betalingskenmerken</caption><tr><th scope="col">Jaar</th><th scope="col">Aangiftetijdvak</th><th scope="col">Aangiftenummer</th><th scope="col">Betalingskenmerk</th></tr>';
            var sTag = "tr";
            var sHTMLEnd = "</table>";
            var sTagSub = "<td>";
            var sTagSubEnd = "</td>";

        } else {
            var sTag = "p";
            var sHTML = "<h2>Aangifte-, aanslag- of beschikkingsnummer</h2><p>";
            var sTagSub = "";
            var sTagSubEnd = "";
            var sHTMLEnd = "";
        }
        for (var i = 0; i < aTijdvak.length; i++) {

            var sAanslagnummer = sTagSub + MaakSofiOp(sSofinummer) + "." + sMiddelCode + "." + sSubnr + "." + document.getElementById("selectBtwLhJaar").value + aTijdvak[i][1] + "0" + sTagSubEnd;

            var tmpBetalingskenmerk = sSofinummer.substr(0, 8) + sMidddelBetalingskenmerk + document.getElementById("selectBtwLhJaar").value + sSubnr + aTijdvak[i][1] + 0;
            var iControlegetal = 0;
            for (ii = 0; ii <= 14; ii++) {
                iControlegetal = iControlegetal + parseInt(tmpBetalingskenmerk.charAt(14 - ii)) * arGewichten[ii]
            }
            iControlegetal = 11 - (iControlegetal % 11);
            if (iControlegetal == 10) {
                iControlegetal = 1
            }
            if (iControlegetal == 11) {
                iControlegetal = 0
            }
            tmpBetalingskenmerk = iControlegetal + tmpBetalingskenmerk.substring(0, 3) + " " + tmpBetalingskenmerk.substring(3, 7) + " " + tmpBetalingskenmerk.substring(7, 11) + " " + tmpBetalingskenmerk.substring(11);
            var sBetalingskenmerk = sTagSub + tmpBetalingskenmerk + sTagSubEnd;

            if (aTijdvak.length > 1) {
                sHTML += "<tr><td>" + $("#selectBtwLhJaar option:selected").text() + "</td><td>" + aTijdvak[i][0] + "</td>" + sAanslagnummer + sBetalingskenmerk + "</" + sTag + ">";
            } else {
                sHTML += sAanslagnummer + "</" + sTag + "><h2>Betalingskenmerk</h2><" + sTag + ">" + sBetalingskenmerk + "</" + sTag + ">";
            }
        }
        document.getElementById("spanAanslagnummer").innerHTML = sHTML;
        document.getElementById("spanBetalingsKenmerk").innerHTML = "";
        doUitvoerResult("divResult");

    }
}

function ChechBetKenm(strWaarde, iPosities, strVolgendVeld, e) {
    if (strWaarde.length == iPosities && RegExpAllNumeric(strWaarde, iPosities) == true) {
        if (e.keyCode != 9 && e.keyCode != 16 && e.keyCode != 33 && e.keyCode != 34 && e.keyCode != 35 && e.keyCode != 36 && e.keyCode != 37 && e.keyCode != 39) {
            if (strVolgendVeld !== "ok_but") SetFocus(strVolgendVeld);
        }
    }
}

function BelastingjaarIs2011ofLater(strBelJaar) {
    if (parseInt(strHuidigJaarFull) <= 2019) {
        if (parseInt(strBelJaar) > parseInt(strHuidigJaar) || strBelJaar == "0") {
            return false;
        }
    }
    return true;
}

function berekenDecennium(strBelJaar) {
    var iBelJaar = parseInt(strBelJaar);
    var iSysJaar = parseInt(strHuidigJaar);
    var iSysDecennium = parseInt(strHuidigJaarFull.substr(2, 1));
    var iDecennium = iBelJaar <= iSysJaar ? iSysDecennium : iSysDecennium - 1;
    return iDecennium.toString();
}

function checkRestant(strWaarde, iPosities) {
    var strMiddelcode = document.getElementById("frmBerekening").selectMiddelcode.value;

    if ((strMiddelcode == "h") || (strMiddelcode == "n") || (strMiddelcode == "s")) {
        var strJaar = document.getElementById("frmBerekening").H.value.substring(0, 1);
        if (BelastingjaarIs2011ofLater(strJaar)) {
            var iPosities = document.getElementById('H').maxLength = 4;
        } else {
            var iPosities = document.getElementById('H').maxLength = 2;
        }
    }
    if (strMiddelcode == "w") {
        var strJaar = strWaarde.charAt(0);
        var strMiddelherkenning = strWaarde.charAt(2);
        if (BelastingjaarIs2011ofLater(strJaar) && (strMiddelherkenning != '6' && strMiddelherkenning != '7')) {
            var iPosities = document.getElementById('W').maxLength = 5;
        } else {
            document.getElementById('W').maxLength = 3;
        }
    }
    if (isNummer(strWaarde) && strWaarde.length >= iPosities) {
        document.getElementById("genereer").style.display = "block";
    } else {
        document.getElementById("genereer").style.display = "none";
    }
}

function stripString(strWaarde, strTheStrip) {

    return strWaarde.replace(new RegExp("^" + strTheStrip + "*(.*?)"), "$1");
}

var sVorigSofinummer

function CheckSofi(sSofi) {
    sSofi = verwijderKarakters(sSofi, false);
    if (sSofi != sVorigSofinummer) {
        sVorigSofinummer = sSofi;
        if (sSofi.length >= 7) {
            if (!isNummer(sSofi) || sSofi.indexOf(".") > -1) {
                alert("Sofinummer mag alleen cijfers bevatten");
                return false;
            } else {
                if (CheckSofiControleGetal(sSofi)) {
                    document.getElementById("pMiddelCode").style.display = "block";
                    document.getElementById("restant").style.display = "none";
                    document.getElementById("genereer").style.display = "none";
                } else {
                    document.getElementById("pMiddelCode").style.display = "none";
                    document.getElementById("restant").style.display = "none";
                    document.getElementById("genereer").style.display = "none";
                    toonDivs("", "divResult", "fsUitvoer", "");
                }
            }
        } else {
            document.getElementById("pMiddelCode").style.display = "none";
            document.getElementById("restant").style.display = "none";
            document.getElementById("genereer").style.display = "none";
            toonDivs("", "divResult", "fsUitvoer", "");
        }
    }
    return sSofi;
}

function CheckSofi_onblur(sSofi, bAlert) {
    if (sSofi.length >= 7) {
        if (CheckSofiControleGetal(sSofi)) {
            document.getElementById("pMiddelCode").style.display = "block";
            document.getElementById("restant").style.display = "none";
            document.getElementById("genereer").style.display = "none";
        } else {
            document.getElementById("pMiddelCode").style.display = "none";
            document.getElementById("restant").style.display = "none";
            document.getElementById("genereer").style.display = "none";
            toonDivs("", "divResult", "fsUitvoer", "");
            if (bAlert == true) {
                alert("U hebt een BSN of RSIN ingevuld dat ongeldig is. Vul dit nummer opnieuw in.");
                SetFocus("inputSofi");
            }
            return false;
        }
        return true;
    } else {
        document.getElementById("pMiddelCode").style.display = "none";
        document.getElementById("restant").style.display = "none";
        document.getElementById("genereer").style.display = "none";
        toonDivs("", "divResult", "fsUitvoer", "");
    }
}

function CheckSofiControleGetal(strWaarde) {
    while (strWaarde.length != 9) {
        strWaarde = "0" + strWaarde
    }
    var iTemp = 0;
    var strControleGetal = strWaarde.substring(8, 9);
    for (i = 0; i <= 7; i++) {
        iTemp = iTemp + (parseInt(strWaarde.substring(i, i + 1)) * (9 - i))
    }
    strWaarde = iTemp % 11;
    if (strWaarde == strControleGetal) {
        iControlegetal = strControleGetal;
        return true;
    } else {
        return false;
    }
}

function MaakSofiOp(strWaarde) {
    if (strWaarde.length == 9) {
        strWaarde = strWaarde.substring(0, 4) + "." + strWaarde.substring(4, 6) + "." + strWaarde.substring(6)
    }
    if (strWaarde.length == 8) {
        strWaarde = strWaarde.substring(0, 3) + "." + strWaarde.substring(3, 5) + "." + strWaarde.substring(5)
    }
    if (strWaarde.length == 7) {
        strWaarde = strWaarde.substring(0, 2) + "." + strWaarde.substring(2, 4) + "." + strWaarde.substring(4)
    }
    return strWaarde
}

function CheckBetalingskenmerk(strBetalingskenmerk) {
    if (strBetalingskenmerk.length != 16) {
        return false
    }
    var iControlegetal = 0;
    for (i = 0; i <= 14; i++) {
        iControlegetal = iControlegetal + parseInt(strBetalingskenmerk.charAt(15 - i)) * arGewichten[i]
    }
    iControlegetal = iControlegetal % 11;
    if (iControlegetal > 1) {
        iControlegetal = 11 - iControlegetal
    }
    if (iControlegetal == 1) {
        iControlegetal = 1
    }
    if (iControlegetal == 0) {
        iControlegetal = 0
    }
    if (iControlegetal == strBetalingskenmerk.substring(0, 1)) {
        return true
    }
}

function doKeuzeHelpRestant(oThis) {
    var strMiddelcode = document.getElementById("frmBerekening").selectMiddelcode.value;
    if ((strMiddelcode == "a") || (strMiddelcode == "b") || (strMiddelcode == "d") || (strMiddelcode == "e") || (strMiddelcode == "f") || (strMiddelcode == "l") || (strMiddelcode == "v") || (strMiddelcode == "z")) {
        return doHelp('divHelpRestantABDEFLVZ', oThis);
    } else if ((strMiddelcode == "h") || (strMiddelcode == "n") || (strMiddelcode == "s")) {
        return doHelp('divHelpRestantHNS', oThis);
    } else if ((strMiddelcode == "m") || (strMiddelcode == "y")) {
        return doHelp('divHelpRestantMY', oThis);
    } else if (strMiddelcode == "t") {
        return doHelp('divHelpRestantT', oThis);
    } else if (strMiddelcode == "w") {
        return doHelp('divHelpRestantW', oThis);
    }
}
