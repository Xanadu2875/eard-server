<?php
namespace Eard\Utils;


use pocketmine\item\Item;


/***
*
*	アイテムの、日本語名を入れておくためのやつ
*/
class ItemName{



	public static function getNameOf($id, $meta){
		$id = $item->getId();
		$meta = $item->getMetadata();

		if( isset(self::$listById[$id][$meta]) ){
			return self::$listById[$id][$meta]; //書いてあれば日本語名
		}else{
			return Item::get()->getName(); //書いてなければ英名
		}
	}

	public static function init(){
		// 変換
		$listById = [];
		$listByCat = [];

		foreach(self::$listByName as $name => $i){
			$listById[$i[0]][$i[1]] = $name;
			$listByCat[$i[0]][$i[1]] = isset($i[2]) ? $i[2] : 0;
		}
		self::$listById = $listById;
	}

	public static function getListById(){
		return self::$listById;
	}

	public static function getListByName(){
		return self::$listByName;
	}


	/**
	*	@return int
	*/
	public static function getCategoryOf($id, $meta){
		if( isset(self::$listByCat) ){
			if( isset(self::$listByCat[$id][$meta]) ){
				return self::$listByCat[$id][$meta];
			}
		}
		return 0;
	}


	/*
		20180229 アイテムに、カテゴリを追加。
		0 = 分類不能 販売禁止	名前が「(」か「tile.」からはじまってるやつ
		1 = ふつうのぶろっく (真四角の形をしていたらここに突っ込め 階段とハーフブロックも)
		2 = 装飾ブロック いろがついてるやつ (羊毛/かたやきねんど/てらこった/コンクリ/コンクリパウダー)
		3　= 金属 (木炭/鉱石/鉱石ブロック)
		4 = 設置ブロック 効果があるやつ (ベッド/作業台ビーコン/どあ/さく/ふぇんすげーと)etc)
		5 = 草花 (種系統は9へ)
		6 = RS系統

		7 = 素材 (てきどろっぷ/染料/etc)
		8 = ツール
		9 = たべもの/作物 (にんじん/じゃがいも/たまねぎ/むぎのたね)
	*/
	private static $listByName = [
		// "{$name}" => []
		"焼き石" => [1,0,1],
		"石" => [1,0,1],
		"花崗岩" => [1,1,1],
		"磨かれた花崗岩" => [1,2,1],
		"閃緑岩" => [1,3,1],
		"磨かれた閃緑岩" => [1,4,1],
		"安山岩" => [1,5,1],
		"磨かれた安山岩" => [1,6,1],
		"草ブロック" => [2,0,1],
		"土" => [3,0,1],
		"丸石" => [4,0,1],

		"オークの木材" => [5,0,1],
		"マツの木材" => [5,1,1],
		"カバの木材" => [5,2,1],
		"ジャングルの木材" => [5,3,1],
		"アカシアの木材" => [5,4,1],
		"黒樫の木材" => [5,5,1],
		"ダークオークの木材" => [5,5,1],

		"オークの苗木" => [6,0,5],
		"マツの苗木" => [6,1,5],
		"カバの苗木" => [6,2,5],
		"ジャングルの苗木" => [6,3,5],
		"アカシアの苗木" => [6,4,5],
		"黒樫の苗木" => [6,5,5],
		"ダークオークの苗木" => [6,5,5],

		"岩盤" => [7,0,1],
		"水" => [8,0,4],
		"水" => [9,0,4],
		"溶岩" => [10,0,4],
		"溶岩" => [11,0,4],
		"砂" => [12,0,1],
		"赤砂" => [12,1,1],
		"砂利" => [13,0,1],
		"金鉱石" => [14,0,3],
		"鉄鉱石" => [15,0,3],
		"石炭鉱石" => [16,0,3],

		"オークの木" => [17,0,1],
		"マツの木" => [17,1,1],
		"カバの木" => [17,2,1],
		"ジャングルの木" => [17,3,1],

		"カシの葉" => [18,0,1],
		"マツの葉" => [18,1,1],
		"カバの葉" => [18,2,1],
		"ジャングルの木の葉" => [18,3,1],

		"スポンジ" => [19,0,1],
		"ぬれたスポンジ" => [19,1,1],
		"(スポンジ(未))" => [19,2,1],
		"ガラス" => [20,0,1],
		"ラピスラズリ鉱石" => [21,0,3],
		"ラピスラズリブロック" => [22,0,3],
		"発射装置" => [23,0,4],
		"砂岩" => [24,0,1],
		"模様入り砂岩" => [24,1,1],
		"なめらかな砂岩" => [24,2,1],
		"音ブロック" => [25,0,4],
		"ベッド" => [26,0,0],
		"加速レール" => [27,0,6],
		"パワードレール" => [27,0,6],
		"感知レール" => [28,0,6],
		"ディテクテーターレール" => [28,0,6],
		"吸着ピストン" => [29,0,6],
		"クモの巣" => [30,0,4],
		"シダ" => [31,0,5],
		"草" => [31,1,5],
		"枯れ木" => [32,0,5],
		"ピストン" => [33,0,6],
		"(ピストンの先っちょ)" => [34,0,0],

		"白の羊毛" => [35,0,2],
		"オレンジの羊毛" => [35,1,2],
		"赤紫の羊毛" => [35,2,2],
		"空色の羊毛" => [35,3,2],
		"黄色の羊毛" => [35,4,2],
		"黄緑の羊毛" => [35,5,2],
		"ピンクの羊毛" => [35,6,2],
		"灰色の羊毛" => [35,7,2],
		"薄灰色の羊毛" => [35,8,2],
		"水色の羊毛" => [35,9,2],
		"紫の羊毛" => [35,10,2],
		"青の羊毛" => [35,11,2],
		"茶色の羊毛" => [35,12,2],
		"緑の羊毛" => [35,13,2],
		"赤の羊毛" => [35,14,2],
		"黒の羊毛" => [35,15,2],
		"タンポポ" => [37,0,5],
		"(tile.yellow_flower..name)" => [37,1,0],
		"ポピー" => [38,0,5],
		"ヒスイラン" => [38,1,5],
		"アリウム" => [38,2,5],
		"ヒナソウ" => [38,3,5],
		"赤のチューリップ" => [38,4,5],
		"オレンジのチューリップ" => [38,5,5],
		"白のチューリップ" => [38,6,5],
		"ピンクのチューリップ" => [38,7,5],
		"フランスギク" => [38,8,5],
		"きのこ" => [39,0,5],
		"きのこ" => [40,0,5],
		"金ブロック" => [41,0,3],
		"鉄ブロック" => [42,0,3],
		"石ハーフブロック" => [43,0,1],
		"砂岩ハーフブロック" => [43,1,1],
		"木材ハーフブロック" => [43,2,1],
		"丸石ハーフブロック" => [43,3,1],
		"レンガハーフブロック" => [43,4,1],
		"石レンガハーフブロック" => [43,5,1],
		"クォーツハーフブロック" => [43,6,1],
		"暗黒レンガのハーフブロック" => [43,7,1],
		"(二重の石ハーフブロック)" => [44,0,0],
		"(二重の砂岩ハーフブロック)" => [44,1,0],
		"(二重の木材ハーフブロック)" => [44,2,0],
		"(二重の丸石ハーフブロック)" => [44,3,0],
		"(二重のレンガハーフブロック)" => [44,4,0],
		"(二重の石レンガハーフブロック)" => [44,5,0],
		"(二重のクォーツハーフブロック)" => [44,6,0],
		"(二重の暗黒レンガハーフブロック)" => [44,7,0],
		"レンガ" => [45,0,1],
		"TNT" => [46,0,1],
		"本棚" => [47,0,1],
		"苔石" => [48,0,1],
		"黒曜石" => [49,0,1],
		"たいまつ" => [50,0,4],
		"火" => [51,0,4],
		"モンスター スポーナー" => [52,0,4],
		"オークの階段" => [53,0,2],
		"チェスト" => [54,0,4],
		"レッドストーン" => [55,0,6],
		"ダイヤモンド鉱石" => [56,0],
		"ダイヤモンドブロック" => [57,0],
		"作業台" => [58,0,4],
		"作物" => [59,0,1],
		"農地" => [60,0,1],
		"耕した土" => [60,0,1],
		"かまど" => [61,0,4],
		"(火のついたかまど)" => [62,0,0],
		"看板" => [63,0,4],
		"(オークの木のドアの上半分)" => [64,0,0],
		"はしご" => [65,0,4],
		"レール" => [66,0,6],
		"丸石の階段" => [67,0,1],
		"(壁に張り付いた看板)" => [68,0,0],
		"レバー" => [69,0,6],
		"石の感圧板" => [70,0,6],
		"鉄のドア" => [71,0,6],
		"木製の感圧板" => [72,0,6],
		"レッドストーン鉱石" => [73,0,3],
		"(光るレッドストーン鉱石)" => [74,0,0],
		"レッドストーンのたいまつ" => [75,0,6],
		"レッドストーンのたいまつ" => [76,0,6],
		"ボタン" => [77,0,6],
		"積雪" => [78,0,2],
		"氷" => [79,0,1],
		"雪" => [80,0,1],
		"サボテン" => [81,0,5],
		"粘土" => [82,0,1],
		"サトウキビ" => [83,0,0],
		"オークの木の柵" => [85,0,4],
		"マツの木の柵" => [85,1,4],
		"カバの木の柵" => [85,2,4],
		"ジャングルの木の柵" => [85,3,4],
		"アカシアの木の柵" => [85,4,4],
		"ダークオークの木の柵" => [85,5,4],
		"カボチャ" => [86,0,5],
		"暗黒石" => [87,0,1],
		"ソウルサンド" => [88,0,1],
		"グロウストーン" => [89,0,1],
		"ポータル" => [90,0,0],
		"ジャック・オ・ランタン" => [91,0,4],
		"ケーキ" => [92,0,0],
		"(設置してあるレッドストーンリピーター(ON))" => [93,0,0],
		"(設置してあるレッドストーンリピーター(OFF))" => [94,0,0],
		"木のトラップドア" => [96,0,4],
		"シルバーフィッシュ入りの石" => [97,0,0],
		"シルバーフィッシュ入りの丸石" => [97,1,0],
		"シルバーフィッシュ入り石レンガ" => [97,2,0],
		"シルバーフィッシュの苔の生えた石レンガ" => [97,3,0],
		"ひび割れた石レンガモンスターエッグ" => [97,4,0],
		"模様入り石レンガモンスターエッグ" => [97,5,0],
		"石レンガ" => [98,0,1],
		"苔の生えた石レンガ" => [98,1,1],
		"ひび割れた石レンガ" => [98,2,1],
		"模様入り石レンガ" => [98,3,1],
		"滑らかな石のレンガ" => [98,4,1],
		"茶きのこブロック" => [99,0,0],
		"赤きのこブロック" => [100,0,0],
		"鉄格子" => [101,0,4],
		"ガラス板" => [102,0,2],
		"スイカ" => [103,0,5],
		"(カボチャの茎)" => [104,0,0],
		"(メロンの茎)" => [105,0,0],
		"ツタ" => [106,0,5],
		"オークの木の柵のゲート" => [107,0,4],
		"レンガ階段" => [108,0,1],
		"石レンガ階段" => [109,0,1],
		"菌糸" => [110,0,1],
		"スイレンの葉" => [111,0,5],
		"暗黒レンガ" => [112,0,1],
		"暗黒レンガの柵" => [113,0,4],
		"マツの木の柵" => [113,1,4],
		"カバの木の柵" => [113,2,4],
		"ジャングルの木の柵" => [113,3,4],
		"アカシアの木の柵" => [113,4,4],
		"ダークオークの木の柵" => [113,5,4],
		"暗黒レンガ階段" => [114,0,1],
		"ネザーウォート" => [115,0,0],
		"エンチャントテーブル" => [116,0,4],
		"調合台" => [117,0,0],
		"大釜" => [118,0,0],
		"(エンドポータルのあの宇宙のブロック)" => [119,0,0],
		"エンドポータル" => [120,0,0],
		"エンドストーン" => [121,0,1],
		"ドラゴンの卵" => [122,0,2],
		"レッドストーンランプ" => [123,0,6],
		"(レッドストーンランプ(ON))" => [124,0,0],
		"ドロッパー" => [125,0,6],
		"アクティベーターレール" => [126,0,6],
		"カカオ" => [127,0,5],
		"砂岩の階段" => [128,0,1],
		"エメラルド鉱石" => [129,0,3],
		"エンダーチェスト" => [130,0,4],
		"トリップワイヤーフック" => [131,0,6],
		"トリップワイヤー" => [132,0,6],
		"エメラルドのブロック" => [133,0,3],
		"マツの階段" => [134,0,1],
		"カバの階段" => [135,0,1],
		"ジャングルの木の階段" => [136,0,1],
		"コマンドブロック" => [137,0,6],
		"ビーコン" => [138,0,6],
		"丸石の壁" => [139,0,4],
		"苔の生えた丸石の壁" => [139,1,4],
		"(おいてあるプランター)" => [140,0,0],
		"(生えているニンジン)" => [141,0,0],
		"ジャガイモ" => [142,0,0],
		"ボタン" => [143,0,6],
		"スケルトンの頭" => [144,0,0],
		"ウィザー スケルトンの頭" => [144,1,0],
		"ゾンビの頭" => [144,2,0],
		"ヘッド" => [144,3,0],
		"クリーパー ヘッド" => [144,4,0],
		"ドラゴンの頭" => [144,5,0],
		"金床" => [145,0,4],
		"少し壊れた金床" => [145,1,4],
		"かなり壊れた金床" => [145,2,4],
		"トラップチェスト" => [146,0,6],
		"重量感知板 (軽)" => [147,0,6],
		"重量感知板 (重)" => [148,0,6],
		"(置かれたレッドストーンコンパレーター(OFF))" => [149,0,0],
		"(置かれたレッドストーンコンパレーター(ON))" => [150,0,0],
		"日照センサー" => [151,0,6],
		"レッドストーンのブロック" => [152,0,3],
		"闇のクォーツ鉱石" => [153,0,1],
		"ホッパー" => [154,0,0],
		"クォーツのブロック" => [155,0,1],
		"模様入りクォーツのブロック" => [155,1,1],
		"柱状のクォーツのブロック" => [155,2,1],
		"クォーツの階段" => [156,0,1],

		"(二重のオークのハーフブロック)" => [157,0,0],
		"(二重のマツのハーフブロック)" => [157,1,0],
		"(二重のカバのハーフブロック)" => [157,2,0],
		"(二重のジャングルの木のハーフブロック)" => [157,3,0],
		"(二重のアカシアの木のハーフブロック)" => [157,4,0],
		"(二重のダークオークの木のハーフブロック)" => [157,5,0],
		"(二重の何かの木のハーフブロック)" => [157,6,0],

		"オークのハーフブロック" => [158,0,1],
		"マツのハーフブロック" => [158,1,1],
		"カバのハーフブロック" => [158,2,1],
		"ジャングルの木のハーフブロック" => [158,3,1],
		"アカシアの木のハーフブロック" => [158,4,1],
		"ダークオークの木のハーフブロック" => [158,5,1],
		"(何かの木のハーフブロック)" => [158,6,0],

		"白の色付き粘土" => [159,0,2],
		"オレンジの色付き粘土" => [159,1,2],
		"赤紫の色付き粘土" => [159,2,2],
		"空色の色付き粘土" => [159,3,2],
		"黄色の色付き粘土" => [159,4,2],
		"黄緑の色付き粘土" => [159,5,2],
		"ピンクの色付き粘土" => [159,6,2],
		"灰色の色付き粘土" => [159,7,2],
		"薄灰色の色付き粘土" => [159,8,2],
		"水色の色付き粘土" => [159,9,2],
		"紫の色付き粘土" => [159,10,2],
		"青の色付き粘土" => [159,11,2],
		"茶色の色付き粘土" => [159,12,2],
		"緑の色付き粘土" => [159,13,2],
		"赤の色付き粘土" => [159,14,2],
		"黒の色付き粘土" => [159,15,2],

		"ガラス板" => [160,0,2],

		"アカシアの葉" => [161,0,5],
		"ダークオーク木の葉" => [161,1,5],
		"アカシアの原木" => [162,0,5],
		"ダークオークの原木" => [162,1,5],
		"アカシアの木の階段" => [163,0,5],
		"ダークオークの木の階段" => [164,0,5],

		"スライムブロック" => [165,0,1],
		"鉄のトラップドア" => [167,0,4],
		"海晶ブロック" => [168,0,5],
		"暗海晶ブロック" => [168,1,0],
		"海晶レンガ" => [168,2,0],
		"海のランタン" => [169,0,4],
		"麦俵" => [170,0,5],

		"白のカーペット" => [171,0,2],
		"オレンジのカーペット" => [171,1,2],
		"赤紫のカーペット" => [171,2,2],
		"空色のカーペット" => [171,3,2],
		"黄色のカーペット" => [171,4,2],
		"黄緑のカーペット" => [171,5,2],
		"ピンクのカーペット" => [171,6,2],
		"灰色のカーペット" => [171,7,2],
		"薄灰色のカーペット" => [171,8,2],
		"水色のカーペット" => [171,9,2],
		"紫のカーペット" => [171,10,2],
		"青のカーペット" => [171,11,2],
		"茶色のカーペット" => [171,12,2],
		"緑のカーペット" => [171,13,2],
		"赤のカーペット" => [171,14,2],
		"黒のカーペット" => [171,15,2],

		"堅焼き粘土" => [172,0,0],
		"石炭のブロック" => [173,0,3],
		"氷塊ブロック" => [174,0,1],
		"ヒマワリ" => [175,0,5],
		"ライラック" => [175,1,5],
		"高い草" => [175,2,5],
		"大きなシダ" => [175,3,5],
		"バラの低木" => [175,4,5],
		"ボタン" => [175,5,5],
		"tile.daylight_detector_inverted.name" => [178,0,0],
		"赤砂岩" => [179,0,1],
		"模様入りの赤砂岩" => [179,1,1],
		"滑らかな赤砂岩" => [179,2,1],
		"赤砂岩の階段" => [180,0,1],
		"赤砂岩のハーフブロック" => [181,0,1],
		"tile.double_stone_slab2.purpur.name" => [181,1,0],
		"tile.double_stone_slab2.stone.name" => [181,2,0],
		"赤砂岩のハーフブロック" => [182,0,1],
		"プルプァのハーフブロック" => [182,1,1],
		"tile.stone_slab2.stone.name" => [182,2,0],

		"マツの木の柵のゲート" => [183,0,4],
		"オークの木の柵のゲート" => [184,0,4],
		"ジャングルの木の柵のゲート" => [185,0,4],
		"ダークオークの木の柵のゲート" => [186,0,4],
		"アカシアの木の柵のゲート" => [187,0,4],

		"コマンドブロックの反復" => [188,0,6],
		"コマンドブロックのチェーン" => [189,0,6],

		"(マツの木のドアの上半分)" => [193,0,0],
		"(樺の木のドアの上半分)" => [194,0,0],
		"(ジャングルの木のドアの上半分)" => [195,0,0],
		"(アカシアのドアの上半分)" => [196,0,0],
		"(黒樫の木のドアの上半分)" => [431,0,0],
		"(ダークオークの木のドアの上半分)" => [197,0,0],

		"草の道" => [198,0,0],
		"(設置してある額縁)" => [199,0,0],
		"コーラスの花" => [200,0,5],
		"プルプァ ブロック" => [201,0,1],
		"tile.purpur_block.chiseled.name" => [201,1,0],
		"プルプァの柱" => [201,2,1],
		"プルプァの階段" => [203,0,1],
		"エンドストーンレンガ" => [206,0,1],
		"tile.frosted_ice.name" => [207,0,0],
		"果てのロッド" => [208,0,4],
		"tile.end_gateway.name" => [209,0,0],
		"マグマブロック" => [213,0,4],
		"暗黒茸ブロック" => [214,0,1],
		"赤い暗黒レンガ" => [215,0,1],
		"骨ブロック" => [216,0,1],

		"白のシュルカー ボックス" => [218,0,0],
		"オレンジのシュルカー ボックス" => [218,1,0],
		"赤紫のシュルカー ボックス" => [218,2,0],
		"空色のシュルカー ボックス" => [218,3,0],
		"黄色のシュルカー ボックス" => [218,4,0],
		"黄緑のシュルカー ボックス" => [218,5,0],
		"ピンクのシュルカー ボックス" => [218,6,0],
		"灰色のシュルカー ボックス" => [218,7,0],
		"薄灰色のシュルカー ボックス" => [218,8,0],
		"水色のシュルカー ボックス" => [218,9,0],
		"紫のシュルカー ボックス" => [218,10,0],
		"青のシュルカー ボックス" => [218,11,0],
		"茶色のシュルカー ボックス" => [218,12,0],
		"緑のシュルカー ボックス" => [218,13,0],
		"赤のシュルカー ボックス" => [218,14,0],
		"黒のシュルカー ボックス" => [218,15,0],

		"紫の彩釉テラコッタ" => [219,0,2],
		"白の彩釉テラコッタ" => [220,0,2],
		"オレンジの彩釉テラコッタ" => [221,0,2],
		"赤紫の彩釉テラコッタ" => [222,0,2],
		"空色の彩釉テラコッタ" => [223,0,2],
		"黄色の彩釉テラコッタ" => [224,0,2],
		"黄緑の彩釉テラコッタ" => [225,0,2],
		"ピンクの彩釉テラコッタ" => [226,0,2],
		"灰色の彩釉テラコッタ" => [227,0,2],
		"薄灰色の彩釉テラコッタ" => [228,0,2],
		"水色の彩釉テラコッタ" => [229,0,2],
		"青の彩釉テラコッタ" => [231,0,2],
		"茶色の彩釉テラコッタ" => [232,0,2],
		"緑の彩釉テラコッタ" => [233,0,2],
		"赤の彩釉テラコッタ" => [234,0,2],
		"黒の彩釉テラコッタ" => [235,0,2],

		"白のコンクリート" => [236,0,2],
		"オレンジのコンクリート" => [236,1,2],
		"赤紫のコンクリート" => [236,2,2],
		"空色のコンクリート" => [236,3,2],
		"黄色のコンクリート" => [236,4,2],
		"黄緑のコンクリート" => [236,5,2],
		"ピンクのコンクリート" => [236,6,2],
		"灰色のコンクリート" => [236,7,2],
		"薄灰色のコンクリート" => [236,8,2],
		"水色のコンクリート" => [236,9,2],
		"紫のコンクリート" => [236,10,2],
		"青のコンクリート" => [236,11,2],
		"茶色のコンクリート" => [236,12,2],
		"緑のコンクリート" => [236,13,2],
		"赤のコンクリート" => [236,14,2],
		"黒のコンクリート" => [236,15,2],

		"白のコンクリート パウダー" => [237,0,2],
		"オレンジのコンクリート パウダー" => [237,1,2],
		"赤紫のコンクリート パウダー" => [237,2,2],
		"空色のコンクリート パウダー" => [237,3,2],
		"黄色のコンクリート パウダー" => [237,4,2],
		"黄緑のコンクリート パウダー" => [237,5,2],
		"ピンクのコンクリート パウダー" => [237,6,2],
		"灰色のコンクリート パウダー" => [237,7,2],
		"薄灰色のコンクリート パウダー" => [237,8,2],
		"水色のコンクリート パウダー" => [237,9,2],
		"紫のコンクリート パウダー" => [237,10,2],
		"青のコンクリート パウダー" => [237,11,2],
		"茶色のコンクリート パウダー" => [237,12,2],
		"緑のコンクリート パウダー" => [237,13,2],
		"赤のコンクリート パウダー" => [237,14,2],
		"黒のコンクリート パウダー" => [237,15,2],

		"コーラスプラント"=>[240,0,0],
		"ストーンカッター"=>[245,0,0],
		"(赤黒曜石)"=>[246,0,0],
		"ネザーリアクターコア"=>[247,0,0],
		"オブザーバー"=>[251,0,6],

		"鉄のスコップ" => [256, 0,8],
		"鉄のピッケル" => [257,0,8],
		"鉄のオノ" => [258,0,8],
		"打ち金と火打石" => [259,0,8],
		"りんご" => [260,0,9],
		"弓" => [261,0,8],
		"矢" => [262,0,8],
		"石炭" => [263,0,3],
		"ダイヤモンド" => [264,0,3],
		"鉄インゴット" => [265,0,3],
		"金インゴット" => [266,0,3],
		"鉄のソード" => [267,0,8],
		"木のソード" => [268,0,8],
		"木のスコップ" => [269,0,8],
		"木のピッケル" => [270,0,8],
		"木のオノ" => [271,0,8],
		"石のソード" => [272,0,8],
		"石のスコップ" => [273,0,8],
		"石のピッケル" => [274,0,8],
		"石のオノ" => [275,0,8],
		"ダイヤのソード" => [276,0,8],
		"ダイヤのスコップ" => [277,0,8],
		"ダイヤのピッケル" => [278,0,8],
		"ダイヤのオノ" => [279,0,8],
		"木の棒" => [280,0,7],
		"棒" => [280,0,7],
		"ボウル" => [281,0,7],
		"おわん" => [281,0,7],
		"マッシュルームスープ" => [282,0,9],
		"きのこのスープ" => [282,0,9],
		"金のソード" => [283,0,8],
		"金のスコップ" => [284,0,8],
		"金のピッケル" => [285,0,8],
		"金のオノ" => [286,0,8],
		"糸" => [287,0,7],
		"羽" => [288,0,7],
		"火薬" => [289,0,7],
		"木のクワ" => [290,0,8],
		"石のクワ" => [291,0,8],
		"鉄のクワ" => [292,0,8],
		"ダイヤのクワ" => [293,0,8],
		"金のクワ" => [294,0,8],
		"麦の種" => [295,0,9],
		"麦" => [296,0,9],
		"おいしいパン" => [297,0,9],
		"革のヘルメット" => [298,0,8],
		"革のチェストプレート" => [299,0,8],
		"革のレギンス" => [300,0,8],
		"革のブーツ" => [301,0,8],
		"チェーンのヘルメット" => [302,0,8],
		"チェーンのチェストプレート" => [303,0,8],
		"チェーンのレギンス" => [304,0,8],
		"チェーンのブーツ" => [305,0,8],
		"鉄のヘルメット" => [306,0,8],
		"鉄のチェストプレート" => [307,0,8],
		"鉄のレギンス" => [308,0,8],
		"鉄のブーツ" => [309,0,8],
		"ダイヤのヘルメット" => [310,0,8],
		"ダイヤのチェストプレート" => [311,0,8],
		"ダイヤのレギンス" => [312,0,8],
		"ダイヤのブーツ" => [313,0,8],
		"金のヘルメット" => [314,0,8],
		"金のチェストプレート" => [315,0,8],
		"金のレギンス" => [316,0,8],
		"金のブーツ" => [317,0,8],
		"火打ち石" => [318,0,8],
		"火打石" => [318,0,8],
		"生の豚肉" => [319,0,9],
		"焼き豚肉" => [320,0,9],
		"絵画" => [321,0,8],
		"金のりんご" => [322,0,9],
		"金りんご" => [322,0,9],
		"看板" => [323,0,8],
		"オークの木のドア" => [324,0,8],
		"バケツ" => [325,0,8],
		"トロッコ" => [328,8],
		"鞍" => [329,0,0],
		"鉄のドア" => [330,0,8],
		"レッドストーン" => [331,0,3],
		"雪玉" => [332,0,8],
		"オークの木のボート" => [333,0,0],
		"革" => [334,0,7],
		"レンガ" => [336,0,7],
		"粘土" => [337,0,7],
		"サトウキビ" => [338,0,9],
		"紙" => [339,0,7],
		"本" => [340,0,7],
		"スライムボール" => [341,0,7],
		"チェスト付きトロッコ" => [342,0,0],
		"タマゴ" => [344,0,9],
		"コンパス" => [345,0,8],
		"釣り竿" => [346,0,0],
		"時計" => [347,0,8],
		"グロウストーンダスト" => [348,0,7],
		"生の魚" => [349,0,9],
		"焼き魚" => [350,0,9],
		"墨袋" => [351,0,7],
		"赤色の染料" => [351,1,7],
		"緑色の染料" => [351,2,7],
		"カカオ豆" => [351,3,7],
		"ラピスラズリ" => [351,4,7],
		"紫色の染料" => [351,5,7],
		"水色の染料" => [351,6,7],
		"薄灰色の染料" => [351,7,7],
		"灰色の染料" => [351,8,7],
		"桃色の染料" => [351,9,7],
		"黄緑色の染料" => [351,10,7],
		"黄色の染料" => [351,11,7],
		"空色の染料" => [351,12,7],
		"赤紫色の染料" => [351,13,7],
		"橙色の染料" => [351,14,7],
		"骨粉" => [351,15,7],
		"骨" => [352,0,7],
		"砂糖" => [353,0,7],
		"ケーキ" => [354,0,9],
		"白色のベッド" => [355,0,4],
		"橙色のベッド" => [355,1,4],
		"赤紫色のベッド" => [355,2,4],
		"空色のベッド" => [355,3,4],
		"黄色のベッド" => [355,4,4],
		"黄緑色のベッド" => [355,5,4],
		"桃色のベッド" => [355,6,4],
		"灰色のベッド" => [355,7,4],
		"薄灰色のベッド" => [355,8,4],
		"青緑色のベッド" => [355,9,4],
		"紫色のベッド" => [355,10,4],
		"青色のベッド" => [355,11,4],
		"茶色のベッド" => [355,12,4],
		"緑色のベッド" => [355,13,4],
		"赤色のベッド" => [355,14,4],
		"黒色のベッド" => [355,15,4],
		"レッドストーンリピーター" => [356,0,6],
		"クッキー" => [357,0,9],
		"地図" => [358,0,0],
		"ハサミ" => [359,0,8],
		"スイカ" => [360,0,9],
		"カボチャの種" => [361,0,9],
		"スイカの種" => [362,0,9],
		"生の牛肉" => [363,0,9],
		"焼き牛肉" => [364,0,9],
		"生の鶏肉" => [365,0,9],
		"焼き鳥肉" => [366,0,9],
		"ゾンビ肉" => [367,0,9],
		"エンダーパール" => [368,0,8],
		"ブレイズロッド" => [369,0,7],
		"ガストの涙" => [370,0,7],
		"金の塊" => [371,0,3],
		"ネザーウォート" => [372,0,7],
		"水のビン" => [373,0,9],
		"ガラスビン" => [374,0,8],
		"クモの目" => [375,0,9],
		"発酵したクモの目" => [376,0,7],
		"ブレイズパウダー" => [377,0,7],
		"マグマクリーム" => [378,0,7],
		"調合台" => [379,0,4],
		"大釜" => [380,0,4],
		"エンダーアイ" => [381,0,7],
		"輝くスイカ" => [382,0,7],
		"スポーンエッグ" => [383,0,0],
		"エンチャントのビン" => [384,0,0],
		"発火剤" => [385,0,],
		"エメラルド" => [388,3],
		"額縁" => [389,4],
		"植木鉢" => [390,4],
		"ニンジン" => [391,9],
		"ジャガイモ" => [392,9],
		"ベイクドポテト" => [393,9],
		"有毒なジャガイモ" => [394,7],
		"空っぽの地図" => [395,0,0],
		"白紙の地図" => [395,0,0],
		"金のニンジン" => [396,0,9],
		"金ニンジン" => [396,0,9],
		"スケルトンの頭" => [,0,2],
		"ウィザー スケルトンの頭" => [397,1,2],
		"ゾンビの頭" => [397,2,2],
		"ヘッド" => [397,3,2],
		"クリーパー ヘッド" => [397,4,2],
		"ドラゴンの頭" => [397,5,2],
		"ニンジン付きの棒" => [398,0,0],
		"ネザースター" => [399,0,7],
		"パンプキン パイ" => [400,0,9],
		"エンチャントした本" => [403,0,0],
		"レッドストーンコンパレーター" => [404,0,6],
		"暗黒レンガ" => [405,0,7],
		"闇のクォーツ" => [406,0,7],
		"TNT付きトロッコ" => [407,0,0],
		"ホッパー付きトロッコ" => [408,0,0],
		"暗海晶の破片" => [409,0,7],
		"ホッパー" => [410,0,6],
		"生の兎肉" => [411,0,9],
		"焼き兎肉" => [412,0,9],
		"ウサギシチュー" => [413,0,9],
		"ウサギの足" => [414,0,7],
		"ウサギの皮" => [415,0,7],
		"革の馬鎧" => [416,0,0],
		"鉄の馬鎧" => [417,0,0],
		"金の馬鎧" => [418,0,0],
		"ダイヤモンドの馬鎧" => [419,0,0],
		"首ひも" => [420,0,8],
		"名札" => [421,0,8],
		"海結晶" => [422,0,7],
		"生の羊肉" => [423,0,9],
		"調理した羊肉" => [424,0,9],
		"果てのクリスタル" => [426,0,0],
		"マツの木のドア" => [427,0,4],
		"カバの木のドア" => [428,0,4],
		"ジャングルの木のドア" => [429,0,4],
		"アカシアのドア" => [430,0,4],
		"ダークオークの木のドア" => [431,0,4],
		"コーラスフルーツ" => [432,0,9],
		"焼いたコーラスフルーツ" => [433,0,7],
		"ドラゴンの息" => [437,0,0],
		"スプラッシュ水のビン" => [438,0,0],
		"残留する水のビン" => [441,0,0],
		"コマンドブロック付きトロッコ" => [443,0,0],
		"虫の羽根" => [444,0,8],
		"シュルカーの殻" => [445,0,7],
		"不死のトーテム" => [450,0,7],
		"鉄塊" => [452,0,3],
		"ビートルート" => [457,0,9],
		"ビートルートの種" => [458,0,9],
		"ビートルート スープ" => [459,0,9],
		"生鮭" => [460,0,9],
		"クマノミ" => [461,0,9],
		"フグ" => [462,0,9],
		"調理した鮭" => [463,0,9],
		"エンチャントされたリンゴ" => [466,0,9],
	];
	private static $listById = [];
}
