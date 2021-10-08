<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Troep.com -&gt; Startpage</title>
    <meta name="description" content="Jimbolinos startpage, the best way to start your surfing day">
    <meta name="keywords" content="Jimbolino, startpage, troep, tilburg">
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0;
            margin: 0;
        }

        td {
            border: 1px solid black;
            text-align: center;
            padding: 0;
            margin: 0;
        }

        img {
            border: none;
        }

        p {
            margin-top: 0;
            margin-bottom: 0;
            min-height: 15px
        }

        input {
            border-width: 1px;
            text-align: center;
            border-color: #111111;
        }

        input.text {
            width: 105px;
        }

        input.submit {
            width: 21px;
            padding: 0;
        }

        select {
            font-size: 8pt;
            border-width: 0;
            width: 35px;
        }

        option {
            border-width: 0;
            text-align: center;
            border-color: #111111;
        }

        div.smalltext {
            font-size: 8pt;
        }

        table.maintable {
            width: 980px;
        }

        td.zoekveld {
            width: 140px;
        }
    </style>
</head>
<body>
<table class="maintable">
    <tbody>
    <tr>
        <td class="zoekveld">
            <form method="get" action="https://www.imdb.com/find">
                <div>imdb.com<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="I"></div>
            </form>
        </td>
        <td class="zoekveld"></td>
        <td class="zoekveld">
            <form method="get" action="https://www.google.com/search">
                <div>google.com<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="G"></div>
            </form>
        </td>
        <td class="zoekveld">
            <form method="get" action="https://www.google.nl/search">
                <div>google.nl<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="G"></div>
            </form>
        </td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
        <td class="zoekveld">
            <form action="https://www.wikipedia.org/search-redirect.php">
                <div>wikipedia
                    <select name="language">
                        <option value="nl" selected="selected">nl</option>
                        <option value="en">en</option>
                    </select>
                    <input class="text" type="text" name="search"><input class="submit" type="submit" name="go"
                                                                         value="W"></div>
            </form>
        </td>
    </tr>
    <tr>
        <td class="zoekveld">
            <form method="get" action="https://subscene.com/subtitles/title">
                <div>subscene<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="S"></div>
            </form>
        </td>
        <td class="zoekveld">
            <form method="get" action="https://www.ondertitel.com/zoeken.php">
                <div>ondertitel.com<br>
                    <input type="hidden" value="zoek" name="p"><input class="text" type="text" name="trefwoord"><input
                        value="O" class="submit" type="submit"></div>
            </form>
        </td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
        <td class="zoekveld">
            <form method="get" action="https://torrentproject.se/">
                <div>torrentproject.se<br>
                    <input class="text" type="text" name="t"><input class="submit" type="submit" value="T"></div>
            </form>
        </td>
        <td class="zoekveld">
            <form method="get" action="https://torrentz2.is/search">
                <div>torrentz2.is<br>
                    <input class="text" type="text" name="f"><input class="submit" type="submit" value="T"></div>
            </form>
        </td>
        <td class="zoekveld"></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <div class="smalltext">{{ config('app.timezone') }}: {{ date('H:i') }} -
                Welcome: {{ request()->ip() }}</div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td><p><a href="/tha-music.htm"><b>Music</b></a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.nu.nl/"><b>NU.NL</b></a></p></td>
        <td><p><a href="/troep"><b>/TROEP</b></a></p></td>
        <td><p><a href="https://tweakers.net/">TWEAKERS.NET</a></p></td>
        <td><p><a href="https://gathering.tweakers.net">GoT</a></p></td>
        <td><p></p></td>
        <td style="background-color:{{ $color }}"><p><a
                    href="https://en.wikipedia.org/wiki/Thai_solar_calendar#Weeks">{{ date('l') }}</a></p></td>
    </tr>
    <tr>
        <td><p>Frequence3 <a href="http://hd.stream.frequence3.net/frequence3.flac.m3u">flac</a> <a
                    href="http://hd.stream.frequence3.net/frequence3-256.mp3.m3u">256</a></p></td>
        <td><p><a href="https://trailers.apple.com/trailers/">trailers.apple.com</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://frontpage.fok.nl/">fok.nl</a></p></td>
        <td><p><a href="/tools/time.php?refresh=5">phptime</a></p></td>
        <td><p><a href="https://www.tweakers.net/meuktracker">t.net/meuktracker</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_bookmarks">BM</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="http://play.deep.fm/deepfm.pls">DeepFM</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="/tools/viewsource.php">viewsource</a></p></td>
        <td><p><a href="https://www.tweakers.net/pricewatch">t.net/pricewatch</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/find">find</a></p></td>
        <td><p><a href="/linux.htm">Linux.htm</a></p></td>
        <td><p><a href="https://www.knmi.nl/">knmi.nl</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.fresh.fm/media/audio/ListenHigh.pls">Fresh FM</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.p2000-online.net/middenenwestbrabantf.html">p2000-online</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://tweakers.net/aanbod/zoeken/">t.net/aanbod</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_activetopics">AT</a></p></td>
        <td><p><a href="/bookmarks.htm">Bookmarks.htm</a></p></td>
        <td><p><a href="http://www.weer.nl/">weer.nl</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://stream.slam.nl/slam">SlamFM</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://translate.google.nl/">google translate</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.buienradar.nl/">buienradar</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.decibel.nl/streams/Radio_Decibel_Nederland.asx">Decibel 1</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.marktplaats.nl/">marktplaats</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/19">N&amp;T</a></p></td>
        <td><p><a href="https://login.binck.nl/klanten/">Binck</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.radiodecibel.nl/listen.pls">Decibel 2</a></p></td>
        <td><p></p></td>
        <td><p><a href="http://9292.nl/">9292.nl</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.ebay.com/">ebay</a> <a href="https://www.ebay.nl/">.nl</a> <a
                    href="https://www.benl.ebay.be/">.be</a> <a href="https://www.ebay.de/">.de</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/11">WOS</a></p></td>
        <td><p><a href="https://www.argenta.nl/nl/">Argenta</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="http://playerservices.streamtheworld.com/api/livestream-redirect/RADIO538.mp3">Radio 538</a></p>
        </td>
        <td><p><a href="http://www.nummerzoeker.com/">zoekopnummer</a></p></td>
        <td><p><a href="http://www.ns.nl/">ns.nl</a> - <a
                    href="http://www.prorail.nl/reizigers/werkzaamheden-en-storingen">prorail</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.vergelijken.nl/">vergelijken.nl</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/23">NOS</a></p></td>
        <td><p><a href="https://www.robeco.nl/">Robeco</a></p></td>
        <td><p><a href="http://www.sligro.nl/aanbiedingen.asp">sligro</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://icecast.omroep.nl/3fm-bb-mp3.m3u">Radio3FM</a></p></td>
        <td><p><a href="http://www.detelefoongids.nl/">telefoongids</a></p></td>
        <td><p><a href="http://route.anwb.nl/">anwb</a> - <a href="http://www.routenet.nl/">routenet</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.webkoop.nl/">webkoop.nl</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/10">SA</a></p></td>
        <td><p><a href="https://bankieren.rabobank.nl/klanten/">Rabobank</a></p></td>
        <td><p><a href="http://www.aldi.nl/">aldi</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://stream.pro-fm.net:8200/listen.pls">Pro FM</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://maps.here.com/">here</a> - <a href="https://www.google.nl/maps">google</a></p></td>
        <td><p><a href="https://www.facebook.com/">facebook</a></p></td>
        <td><p><a href="https://www.whatismyip.com/">whatismyip</a></p></td>
        <td><p><a href="http://jouwaanbieding.nl/">jouwaanbieding.nl</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/4">I&amp;T</a></p></td>
        <td><p><a href="https://mijn.ing.nl/internetbankieren/">mijn.ING</a></p></td>
        <td><p><a href="http://www.lidl.nl/">lidl</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.etn.fm/">ETN</a> <a href="http://ch1relay1.etn.fm:8130/listen.pls?sid=1">1</a> <a
                    href="http://www.etn.fm:8200/house-mp3-320">2</a> <a
                    href="http://omega.etn.fm:9300/dnb-mp3-320">3</a></p></td>
        <td><p></p></td>
        <td><p><a href="http://flits.flitsservice.nl/meldingen/vandaag.aspx">flitsservice</a> - <a
                    href="http://www.anwb.nl/verkeer">anwb</a></p></td>
        <td><p><a href="https://www.youtube.com/feed/subscriptions">youtube</a></p></td>
        <td><p><a href="/ip">ip.troep.com</a></p></td>
        <td><p><a href="https://nl.pepper.com/nieuw">pepper</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/31">HK</a></p></td>
        <td><p><a href="https://www.knab.nl/">Knab</a></p></td>
        <td><p><a href="http://www.action.nl/">Action</a></p></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <div class="smalltext">set this page as startpage or bookmark it !</div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td><p><b>CLIENTS</b></p></td>
        <td><p><b>TORRENT (priv)</b></p></td>
        <td><p><b>TORRENT (pub)</b></p></td>
        <td><p><b>MUSIC</b></p></td>
        <td><p><b>SUBS</b></p></td>
        <td><p><b>SERIALS</b></p></td>
        <td><p><b>COVERS</b></p></td>
        <td><p><b>GSM</b></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.qbittorrent.org/">qBittorrent</a></p></td>
        <td><p><a href="https://alpharatio.cc/torrents.php">alpharatio</a></p></td>
        <td><p><a href="https://1337x.to/">1337x.to</a></p></td>
        <td><p><a href="https://player.spotify.com">spotify</a></p></td>
        <td><p><a href="https://subscene.com/">subscene</a></p></td>
        <td><p><a href="http://astalavista.box.sk/">astalavista</a></p></td>
        <td><p><a href="http://www.cdcovers.cc/">cdcovers.cc</a></p></td>
        <td><p><a href="https://www.telecomvergelijker.nl/">tc-vergelijker</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.frostwire.com/download/">FrostWire</a></p></td>
        <td><p><a href="https://torrentsurf.net/browse.php">torrentsurf</a></p></td>
        <td><p><a href="https://yts.mx/">yts.mx</a></p></td>
        <td><p><a href="http://8tracks.com/">8tracks</a></p></td>
        <td><p><a href="http://www.ondertitel.com/">ondertitel.com</a></p></td>
        <td><p><a href="http://crackspider.net/">crackspider.net</a></p></td>
        <td><p><a href="http://covertarget.com/ct/1/0.html">covertarget.com</a></p></td>
        <td><p><a href="https://www.gsmstunter.nl/">gsmstunter</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://torrentbytes.net/browse.php">torrentbytes</a></p></td>
        <td><p><a href="https://www.limetorrents.cc/">limetorrents.cc</a></p></td>
        <td><p><a href="http://www.partycloud.fm/">partycloud</a></p></td>
        <td><p><a href="http://www.divxsubtitles.net/">divxsubtitles</a></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.coveralia.com/">coveralia.com</a></p></td>
        <td><p><a href="https://www.gsmweb.nl/">gsmweb</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.torrentleech.org/torrents/browse">torrentleech</a></p></td>
        <td><p><a href="https://www.torrentfunk.com/">torrentfunk.com</a></p></td>
        <td><p><a href="http://www.audiotool.com/">audiotool</a></p></td>
        <td><p></p></td>
        <td><p><b>WAREZ</b></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://eztv.re/">eztv.re</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.nforce.nl/">nforce</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><b>IRC</b></p></td>
        <td><p></p></td>
        <td><p><a href="https://yourbittorrent.com/">yourbittorrent.com</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.theisonews.com/">isonews</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.mirc.com/get.html">mIRC</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://rarbg.to/torrents.php">rarbg.to</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.etplanet.com/">Etplanet</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <div class="smalltext">(c) <a href="/mailmij.php">Jimbolino</a> - <a href="/">http://troep.com/</a></div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td colspan="2"><p><b>Software Essentials</b></p></td>
        <td colspan="2"><p><b>Software Less Essentials</b></p></td>
        <td colspan="2"><p><b>Codec Essentials</b></p></td>
        <td colspan="2"><p><b>Driver Essentials</b></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.rarlabs.com/download.htm">WinRAR</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.mozilla.org/en-US/firefox/new/">Firefox</a></p></td>
        <td><p><a href="https://www.mozilla.org/en-US/firefox/new/">latest</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://unchecky.com/">unchecky</a></p></td>
        <td><p><a href="https://unchecky.com/files/unchecky_setup.exe">latest</a></p></td>
        <td><p><a href="http://www.disc-tools.com/download/daemon">daemontools</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://downloadcenter.intel.com/default.aspx">Intel chipset</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.google.nl/chrome/">Google Chrome</a></p></td>
        <td><p><a href="https://www.google.com/apps/intl/en/business/chromebrowser.html">msi</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://downloadcenter.intel.com/default.aspx">Intel old chipset</a></p></td>
        <td><p><a href="ftp://aiedownload.intel.com/df-support/8177/eng/infinst_enu.zip">6.3.0.1007</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.foobar2000.org/">foobar2000</a></p></td>
        <td><p><a href="https://www.foobar2000.org/download">1.3.10</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.sumatrapdfreader.org/download-free-pdf-viewer.html">Sumatra PDF</a></p></td>
        <td><p><a href="https://kjkpub.s3.amazonaws.com/sumatrapdf/rel/SumatraPDF-3.1.1-64-install.exe">3.1.1</a></p>
        </td>
        <td><p><a href="https://www.quicksfv.org/">QuickSFV</a></p></td>
        <td><p><a href="https://www.quicksfv.org/qsfv236.exe">2.36</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.realtek.com.tw/">Realtek</a> <a
                    href="http://www.realtek.com.tw/downloads/downloadsView.aspx?Langid=1&amp;PNid=23&amp;PFid=23&amp;Level=4&amp;Conn=3&amp;DownTypeID=3&amp;GetDown=false#AC">ac97</a>
            </p></td>
        <td><p><a href="ftp://152.104.238.19/pc/audio/WDM_A401.exe">4.01</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://mpc-hc.org/downloads/">MPC-HC</a></p></td>
        <td><p>
                <a href="https://binaries.mpc-hc.org/MPC%20HomeCinema%20-%20x64/MPC-HC_v1.7.10_x64/MPC-HC.1.7.10.x64.exe">1.7.10</a>
            </p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.realtek.com.tw/">Realtek</a> <a
                    href="http://www.realtek.com.tw/downloads/downloadsView.aspx?Langid=1&amp;PNid=24&amp;PFid=24&amp;Level=4&amp;Conn=3&amp;DownTypeID=3&amp;GetDown=false#High%20Definition%20Audio%20Codecs">HD</a>
            </p></td>
        <td><p><a href="ftp://152.104.238.19/pc/audio/WDM_R179.exe">1.79</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.scootersoftware.com/download.php">Beyond Compare</a></p></td>
        <td><p><a href="http://www.scootersoftware.com/BCompare-4.0.7.19761.exe">4.0.7</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html">Putty</a></p></td>
        <td><p><a href="http://the.earth.li/~sgtatham/putty/latest/x86/putty.exe">latest</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p>
                <a href="https://www.reddit.com/r/software/comments/1yez7l/win_utorrent_221_last_utorrent_version_without/">uTorrent</a>
            </p></td>
        <td><p><a href="/troep/ut221.exe">2.2.1</a></p></td>
        <td><p><a href="http://noclone.net/downloadx.asp">NoClone</a></p></td>
        <td><p><a href="http://noclone.net/noclone-enterprise.exe">2007</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.ati.com/support/driver.html">Ati Catalyst</a></p></td>
        <td><p><a href="https://www.google.com/search?q=5-13_xp-2k_dd_ccc_wdm_enu_29124.exe">5.13</a> <a
                    href="https://www.google.com/search?q=6-6_xp-2k_dd_ccc_wdm_enu_33678.exe">6.6</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://locate32.cogit.net/">Locate32</a></p></td>
        <td><p><a href="http://locate32.cogit.net/download/locate32-3.1.11.7100.zip">32</a> - <a
                    href="http://locate32.cogit.net/download/locate32_x64-3.1.11.7100.zip">64</a></p></td>
        <td><p><a href="http://www.winimage.com/">Winimage</a></p></td>
        <td><p><a href="http://winimage.free.fr/winima80.exe">8.0</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.nvidia.com/content/drivers/drivers.asp">Nvidia Forceware</a></p></td>
        <td><p><a href="http://download.nvidia.com/Windows/71.89/71.89_win2kxp_english.exe">71.89</a> <a
                    href="http://download.nvidia.com/Windows/91.31/91.31_winxp2kmce_english_whql.exe">91.31</a></p></td>
    </tr>
    <tr>
        <td><p><a href="http://www.nero.com/eng/downloads/index.php">Nero</a></p></td>
        <td><p><a href="http://jim.troep.com/troep/Nero-8.3.20.0/Nero-8.3.20.0_all_update.exe">8.3.20</a> <a
                    href="http://jim.troep.com/troep/Nero-8.3.20.0/keygen.exe">kg</a></p></td>
        <td><p><a href="https://www.gfi.com/lannetscan/">Languard</a></p></td>
        <td><p><a href="ftp://ftp.gfi.com/lannetscan.exe">7.0</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <a href="https://validator.w3.org/check/referer">xhtml</a> <a
                href="https://jigsaw.w3.org/css-validator/check/referer">css</a>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td><p><b><a href="http://update.microsoft.com/microsoftupdate/">Microsoft Update</a></b></p></td>
        <td colspan="2"><p><b>Troubleshooters</b></p></td>
        <td><p><b>VIRUSSCAN</b></p></td>
        <td><p><b>EXPLOITS</b></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.microsoft.com/downloads">microsoft.com / downloads</a></p></td>
        <td><p><a href="http://www.seagate.com/nl/nl/support/downloads/item/seatools-dos-master/">SeaTools</a></p></td>
        <td><p>
                <a href="http://www.seagate.com/files/www-content/support-content/downloads/seatools/_shared/downloads/SeaToolsDOS223ALL.ISO">2.33</a>
            </p></td>
        <td><p><a href="https://virusscan.jotti.org/">jotti</a></p></td>
        <td><p><a href="http://www.securityfocus.com/">securityfocus</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.memtest86.com/">memtest86</a> <a href="http://www.memtest.org/#downiso">+</a></p>
        </td>
        <td><p><a href="http://www.memtest86.com/downloads/memtest86-iso.zip">6.00 iso</a> - <a
                    href="http://www.memtest86.com/downloads/memtest86-usb.zip">usb</a></p></td>
        <td><p><a href="https://www.virustotal.com/">virustotal</a></p></td>
        <td><p><a href="http://www.cqure.net/">cqure.net</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.dposoft.net/">HDD Regenerator</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://packetstormsecurity.org/">packetstormsecurity</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.jam-software.com/freeware/index.shtml">treesize</a></p></td>
        <td><p><a href="http://www.jam-software.com/freeware/TreeSizeSetup.exe">1.7</a></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.governmentsecurity.org/">governmentsec.</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.netchain.com/netcps/">netcps</a></p></td>
        <td><p><a href="http://www.netchain.com/netcps/NetCPS.exe">1.0</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.hhdsoftware.com/hexeditor.html#Download">hdd-hexeditor</a></p></td>
        <td><p><a href="http://www.hhdsoftware.com/Download/hexedfull.exe">2.0</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.nirsoft.net/utils/web_browser_password.html">Web browser passview</a></p></td>
        <td><p><a href="https://www.nirsoft.net/toolsdownload/webbrowserpassview.zip">1.58</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.nirsoft.net/utils/wireless_key.html">Wireless key view</a></p></td>
        <td><p><a href="https://www.nirsoft.net/toolsdownload/wirelesskeyview.zip">2.05</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.hdtune.com/download.html">HDTune</a></p></td>
        <td><p><a href="http://www.hdtune.com/files/hdtune_255.exe">2.55</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    </tbody>
</table>
<p>I've moved my bookmarks to <a href="/bookmarks.htm">a new page</a></p>
</body>
</html>
