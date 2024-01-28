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
        <td class="zoekveld">
            <form method="get" action="https://googlethatforyou.com/">
                <div>LMGTFY<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="L"></div>
            </form>
        </td>
        <td class="zoekveld">
            <form method="get" action="https://duckduckgo.com/">
                <div>DuckDuckGo<br>
                    <input class="text" type="text" name="q"><input class="submit" type="submit" value="D"></div>
            </form>
        </td>
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
            <form method="post" action="https://subscene.com/subtitles/searchbytitle">
                <div>subscene<br>
                    <input class="text" type="text" name="query"><input class="submit" type="submit" value="S"></div>
            </form>
        </td>
        <td class="zoekveld">
        </td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
        <td class="zoekveld"></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <div class="smalltext">
                {{ config('app.timezone') }}: {{ date('H:i') }} -
                Welcome: {{ $ip }} -
                {{ $flag }}
            </div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td><p><a href="/tha-music.htm"><b>MUSIC</b></a></p></td>
        <td><p><b>VIDEO</b></p></td>
        <td><p><b>TRAVEL</b></p></td>
        <td><p><b>NEWS</b></p></td>
        <td><p><a href="/troep"><b>/TROEP</b></a></p></td>
        <td><p><a href="https://tweakers.net/">TWEAKERS.NET</a></p></td>
        <td><p><a href="https://gathering.tweakers.net">GoT</a></p></td>
        <td><p></p></td>
        <td style="background-color:{{ $color }}"><p><a
                    href="https://en.wikipedia.org/wiki/Thai_solar_calendar#Weeks">{{ date('l') }}</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://luisteren.nl/">Luisteren.nl</a></p></td>
        <td><p><a href="https://www.youtube.com/feed/subscriptions">YouTube</a></p></td>
        <td><p><a href="https://www.skyscanner.nl/">Skyscanner</a></p></td>
        <td><p><a href="https://www.nu.nl/">NU.nl</a></p></td>
        <td><p><a href="/tools/time.php?refresh=5">phptime</a></p></td>
        <td><p><a href="https://www.tweakers.net/meuktracker">t.net/meuktracker</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_bookmarks">BM</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://weareone.fm/">WeAreOne.FM</a></p></td>
        <td><p><a href="https://www.netflix.com/browse">Netflix</a></p></td>
        <td><p><a href="https://www.tickettipper.nl/vliegticketdeals/">TicketTipper</a></p></td>
        <td><p><a href="https://frontpage.fok.nl/">FOK.nl</a></p></td>
        <td><p><a href="/tools/viewsource.php">viewsource</a></p></td>
        <td><p><a href="https://www.tweakers.net/pricewatch">t.net/pricewatch</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/find">find</a></p></td>
        <td><p><a href="/linux.htm">Linux.htm</a></p></td>
        <td><p><a href="https://www.knmi.nl/">knmi.nl</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://open.spotify.com/">Spotify</a></p></td>
        <td><p><a href="https://www.primevideo.com/">Prime Video</a></p></td>
        <td><p><a href="https://esimdb.com/">esimdb</a></p></td>
        <td><p><a href="https://www.bd.nl/">BD.nl</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://tweakers.net/aanbod/zoeken/">t.net/aanbod</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_activetopics">AT</a></p></td>
        <td><p><a href="/bookmarks.htm">Bookmarks.htm</a></p></td>
        <td><p><a href="https://www.weer.nl/">weer.nl</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://music.youtube.com/">YT Music</a></p></td>
        <td><p><a href="https://tv.apple.com/nl">Apple TV+</a></p></td>
        <td><p><a href="https://translate.google.nl/">google translate</a></p></td>
        <td><p><a href="https://www.omroepbrabant.nl/">Omroep Brabant</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.buienradar.nl/">buienradar</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.npostart.nl/live">NPO live</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.bredavandaag.nl/">Breda Vandaag</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.marktplaats.nl/">marktplaats</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/19">N&amp;T</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://9292.nl/">9292.nl</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.ebay.com/">ebay</a> <a href="https://www.ebay.nl/">.nl</a> <a
                    href="https://www.benl.ebay.be/">.be</a> <a href="https://www.ebay.de/">.de</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/11">WOS</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.nummerzoeker.com/?agreecookies=1">zoekopnummer</a></p></td>
        <td><p><a href="https://www.ns.nl/">ns.nl</a> - <a href="https://www.prorail.nl/werkzaamheden-storingen">prorail</a></p></td>
        <td><p><a href="https://www.p2000-online.net/middenenwestbrabantf.html">p2000-online</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/23">NOS</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.sligro.nl/aanbiedingen.html">sligro</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.goudengids.nl/">goudengids</a></p></td>
        <td><p><a href="https://www.anwb.nl/verkeer/routeplanner">anwb</a> - <a href="https://www.routenet.nl/">routenet</a></p></td>
        <td><p><a href="https://www.watwasdieknal.nl/">wat was die knal</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/10">SA</a></p></td>
        <td><p><a href="https://bankieren.rabobank.nl/welcome">Rabobank</a></p></td>
        <td><p><a href="https://www.aldi.nl/">aldi</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://maps.here.com/">here</a> - <a href="https://www.google.nl/maps">google</a></p></td>
        <td><p><a href="https://www.facebook.com/">facebook</a></p></td>
        <td><p><a href="https://www.whatismyip.com/">whatismyip</a></p></td>
        <td><p><a href="https://www.jouwaanbieding.nl/">jouwaanbieding.nl</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/4">I&amp;T</a></p></td>
        <td><p><a href="https://mijn.ing.nl/">Mijn ING</a></p></td>
        <td><p><a href="https://www.lidl.nl/">lidl</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://flitsservice.nl/">flitsservice</a> - <a href="https://www.anwb.nl/verkeer">anwb</a></p></td>
        <td><p></p></td>
        <td><p><a href="/ip">ip.troep.com</a></p></td>
        <td><p><a href="https://nl.pepper.com/nieuw">pepper</a></p></td>
        <td><p><a href="https://gathering.tweakers.net/forum/list_topics/31">HK</a></p></td>
        <td><p><a href="https://www.raisin.nl/referral/?raf=413f3e75450ffefeecff15a2ec73288161f69aae">Raisin</a></p></td>
        <td><p><a href="https://www.action.com/nl-nl/">Action</a></p></td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td>
            <div id="clock" class="smalltext"></div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td><p><b>TORRENT (priv)</b></p></td>
        <td><p><b>TORRENT (pub)</b></p></td>
        <td><p><b>MUSIC</b></p></td>
        <td><p><b>SUBS</b></p></td>
        <td><p><b>SERIALS</b></p></td>
        <td><p><b>COVERS</b></p></td>
        <td><p><b>TELECOM</b></p></td>
        <td><p><b>CASHBACKS</b></p></td>
    </tr>
    <tr>
        <td><p><a href="https://alpharatio.cc/torrents.php">alpharatio</a></p></td>
        <td><p><a href="https://1337x.to/">1337x.to</a></p></td>
        <td><p><a href="https://player.spotify.com">spotify</a></p></td>
        <td><p><a href="https://subscene.com/">subscene</a></p></td>
        <td><p><a href="https://astalavista.box.sk/">astalavista</a></p></td>
        <td><p><a href="https://www.covercentury.com/">Cover Century</a></p></td>
        <td><p><a href="https://www.bellen.com/">bellen.com</a></p></td>
        <td><p><a href="https://www.cashbacksvergelijken.nl/">CBvergelijken</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://torrentsurf.net/browse.php">torrentsurf</a></p></td>
        <td><p><a href="https://yts.mx/">yts.mx</a></p></td>
        <td><p><a href="https://8tracks.com/">8tracks</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://covertarget.com/ct/1/0.html">CoverTarget</a></p></td>
        <td><p><a href="https://www.internetten.nl/">internetten.nl</a></p></td>
        <td><p><a href="https://www.cashbackxl.nl/?share=jimborst-6af2">CashbackXL</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://torrentbytes.net/browse.php">torrentbytes</a></p></td>
        <td><p><a href="https://www.limetorrents.cc/">limetorrents.cc</a></p></td>
        <td><p><a href="https://youdj.online/">YouDJ</a></p></td>
        <td><p><a href="https://www.opensubtitles.org/">opensubtitles</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.pricewise.nl/internet/">Pricewise</a></p></td>
        <td><p><a href="https://www.shopbuddies.nl/u/REF4ecc4fd9b16">ShopBuddies</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.torrentleech.org/torrents/browse">torrentleech</a></p></td>
        <td><p><a href="https://www.torrentfunk.com/">torrentfunk.com</a></p></td>
        <td><p><a href="https://www.audiotool.com/">audiotool</a></p></td>
        <td><p></p></td>
        <td><p><b>WAREZ</b></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.breedbandwinkel.nl/">Breedbandwinkel</a></p></td>
        <td><p><a href="https://www.wissel.nl/">wissel.nl</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://eztv.re/">eztv.re</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.mobiel.nl/">mobiel.nl</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://yourbittorrent.com/">yourbittorrent.com</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.theisonews.com/">isonews</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://www.etplanet.com/">Etplanet</a></p></td>
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
            <div class="smalltext">(c) <a href="/mailmij.php">Jimbolino</a> - <a href="/">https://troep.com/</a></div>
        </td>
    </tr>
    </tbody>
</table>
<table class="maintable">
    <tbody>
    <tr>
        <td colspan="2"><p><b>Software Essentials</b></p></td>
        <td colspan="2"><p><b>Software Less Essentials</b></p></td>
        <td colspan="2"><p><b>Linux Essentials</b></p></td>
        <td colspan="2"><p><b>Driver Essentials</b></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.rarlab.com/download.htm">WinRAR</a></p></td>
        <td><p><a href="https://www.troep.com/meuktracker">latest</a></p></td>
        <td><p><a href="https://www.qbittorrent.org/">qBittorrent</a></p></td>
        <td><p><a href="https://sourceforge.net/projects/qbittorrent/files/latest/download">latest</a></p></td>
        <td><p><a href="https://ubuntu.com/download/desktop">Ubuntu Desktop</a></p></td>
        <td><p><a href="https://releases.ubuntu.com/22.04.3/ubuntu-22.04.3-desktop-amd64.iso>">22.04.3</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.google.nl/chrome/">Google Chrome</a></p></td>
        <td><p><a href="https://chromeenterprise.google/intl/nl_nl/browser/download/">msi</a></p></td>
        <td><p><a href="https://www.reddit.com/r/software/comments/1yez7l/win_utorrent_221_last_utorrent_version_without/">uTorrent</a></p></td>
        <td><p><a href="/troep/ut221.exe">2.2.1</a></p></td>
        <td><p><a href="https://ubuntu.com/download/server">Ubuntu Server</a></p></td>
        <td><p><a href="https://releases.ubuntu.com/22.04.3/ubuntu-22.04.3-live-server-amd64.iso">22.04.3</a></p></td>
        <td><p><a href="https://www.intel.com/content/www/us/en/download-center/home.html">Intel chipset</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://github.com/clsid2/mpc-hc/releases/latest">MPC-HC</a></p></td>
        <td><p><a href="https://www.troep.com/meuktracker">latest</a></p></td>
        <td><p><a href="https://www.frostwire.com/">FrostWire</a></p></td>
        <td><p><a href="https://www.frostwire.com/download">latest</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.intel.com/content/www/us/en/download-center/home.html">Intel old chipset</a></p></td>
        <td><p><a href="ftp://aiedownload.intel.com/df-support/8177/eng/infinst_enu.zip">6.3.0.1007</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.foobar2000.org/">foobar2000</a></p></td>
        <td><p><a href="https://www.troep.com/meuktracker">latest</a></p></td>
        <td><p><a href="https://www.mirc.com/">mIRC</a></p></td>
        <td><p><a href="https://www.mirc.com/get.php">latest</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.scootersoftware.com/download">Beyond Compare</a></p></td>
        <td><p><a href="https://www.scootersoftware.com/files/BCompare-4.4.7.28397.exe">4.4.7</a></p></td>
        <td><p><a href="https://www.quicksfv.org/">QuickSFV</a></p></td>
        <td><p><a href="https://www.quicksfv.org/qsfv236.exe">2.36</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.realtek.com/en/">Realtek</a></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.sumatrapdfreader.org/download-free-pdf-viewer">Sumatra PDF</a></p></td>
        <td><p><a href="https://www.sumatrapdfreader.org/dl/rel/3.5.2/SumatraPDF-3.5.2-64-install.exe">3.5.2</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.mozilla.org/en-US/firefox/new/">Firefox</a></p></td>
        <td><p><a href="https://www.mozilla.org/en-US/firefox/new/">latest</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="http://noclone.net/downloadx.asp">NoClone</a></p></td>
        <td><p><a href="http://noclone.net/noclone-enterprise.exe">2007</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.amd.com/en/support">Ati Catalyst</a></p></td>
        <td><p><a href="https://www.google.com/search?q=5-13_xp-2k_dd_ccc_wdm_enu_29124.exe">5.13</a> <a
                    href="https://www.google.com/search?q=6-6_xp-2k_dd_ccc_wdm_enu_33678.exe">6.6</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://locate32.cogit.net/">Locate32</a></p></td>
        <td><p><a href="https://locate32.cogit.net/download/locate32-3.1.11.7100.zip">32</a> - <a
                    href="https://locate32.cogit.net/download/locate32_x64-3.1.11.7100.zip">64</a></p></td>
        <td><p><a href="https://www.winimage.com/">Winimage</a></p></td>
        <td><p><a href="https://www.winimage.com/download/wima64110.exe">11.0</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.nvidia.com/download/index.aspx">Nvidia Forceware</a></p></td>
        <td><p><a href="http://download.nvidia.com/Windows/71.89/71.89_win2kxp_english.exe">71.89</a> <a
                    href="http://download.nvidia.com/Windows/91.31/91.31_winxp2kmce_english_whql.exe">91.31</a></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.nero.com/eng/downloads/index.php?vlang=en">Nero</a></p></td>
        <td><p><a href="http://jim.troep.com/troep/Nero-8.3.20.0/Nero-8.3.20.0_all_update.exe">8.3.20</a> <a
                    href="http://jim.troep.com/troep/Nero-8.3.20.0/keygen.exe">kg</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
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
        <td><p><b>DEVELOP</b></p></td>
        <td><p><b>WORK</b></p></td>
    </tr>
    <tr>
        <td><p><a href="https://www.microsoft.com/downloads">microsoft.com / downloads</a></p></td>
        <td><p><a href="http://www.seagate.com/nl/nl/support/downloads/item/seatools-dos-master/">SeaTools</a></p></td>
        <td><p><a href="http://www.seagate.com/files/www-content/support-content/downloads/seatools/_shared/downloads/SeaToolsDOS223ALL.ISO">2.33</a></p></td>
        <td><p><a href="https://virusscan.jotti.org/">jotti</a></p></td>
        <td><p><a href="https://gitlab.com/">Gitlab</a></p></td>
        <td><p><a href="https://teams.microsoft.com/">Teams</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.memtest86.com/">memtest86</a> <a href="https://www.memtest.org/">+</a></p></td>
        <td><p><a href="http://www.memtest86.com/downloads/memtest86-iso.zip">6.00 iso</a> - <a href="http://www.memtest86.com/downloads/memtest86-usb.zip">usb</a></p></td>
        <td><p><a href="https://www.virustotal.com/">virustotal</a></p></td>
        <td><p><a href="https://github.com/">Github</a></p></td>
        <td><p><a href="https://outlook.office.com/mail/">Outlook</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="http://www.dposoft.net/">HDD Regenerator</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p><a href="https://www.npmjs.com/">NPM</a></p></td>
        <td><p><a href="https://app.clickup.com/">ClickUp</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.jam-software.com/treesize_free">treesize</a></p></td>
        <td><p><a href="https://downloads.jam-software.de/treesize_free/TreeSizeFreeSetup.exe">4.63</a></p></td>
        <td><p><a href="https://packetstormsecurity.com/">packetstormsecurity</a></p></td>
        <td><p><a href="https://packagist.org/">packagist</a></p></td>
        <td><p><a href="https://sentry.io/">Sentry</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.netchain.com/netcps/">netcps</a></p></td>
        <td><p><a href="https://www.netchain.com/netcps/NetCPS.exe">1.0</a></p></td>
        <td><p><a href="https://www.security.nl/">security.nl</a></p></td>
        <td><p><a href="https://3v4l.org/">3v4l</a></p></td>
        <td><p><a href="https://app.crisp.chat/">Crisp</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.hhdsoftware.com/free-hex-editor">hdd-hexeditor</a></p></td>
        <td><p><a href="https://www.hhdsoftware.com/download/free-hex-editor-neo.exe">7.25</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://chat.openai.com/">ChatGPT</a></p></td>
        <td><p><a href="https://dash.cloudflare.com/">Cloudflare</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.nirsoft.net/utils/web_browser_password.html">Web browser passview</a></p></td>
        <td><p><a href="https://www.nirsoft.net/toolsdownload/webbrowserpassview.zip">1.58</a></p></td>
        <td><p></p></td>
        <td><p><a href="https://laravel-news.com/blog">Laravel News</a></p></td>
        <td><p><a href="https://console.aws.amazon.com/">AWS</a></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.nirsoft.net/utils/wireless_key.html">Wireless key view</a></p></td>
        <td><p><a href="https://www.nirsoft.net/toolsdownload/wirelesskeyview.zip">2.05</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    <tr>
        <td><p></p></td>
        <td><p><a href="https://www.hdtune.com/download.html">HDTune</a></p></td>
        <td><p><a href="https://www.hdtune.com/files/hdtune_255.exe">2.55</a></p></td>
        <td><p></p></td>
        <td><p></p></td>
        <td><p></p></td>
    </tr>
    </tbody>
</table>
<p>I've moved my bookmarks to <a href="/bookmarks.htm">a new page</a></p>

<script>
    function updateClock() {
        document.getElementById("clock").innerText = (new Date()).toString();
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>
