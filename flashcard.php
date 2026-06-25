<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: registration.php");
    exit();
}

$subject = $_GET['subject'] ?? 'abc';

$data = [
  'abc' => [
    ['letter'=>'A', 'word'=>'Apple',    'emoji'=>'🍎'],
    ['letter'=>'B', 'word'=>'Ball',     'emoji'=>'⚽'],
    ['letter'=>'C', 'word'=>'Cat',      'emoji'=>'🐱'],
    ['letter'=>'D', 'word'=>'Dog',      'emoji'=>'🐶'],
    ['letter'=>'E', 'word'=>'Egg',      'emoji'=>'🥚'],
    ['letter'=>'F', 'word'=>'Fish',     'emoji'=>'🐟'],
    ['letter'=>'G', 'word'=>'Grapes',   'emoji'=>'🍇'],
    ['letter'=>'H', 'word'=>'Hat',      'emoji'=>'🎩'],
    ['letter'=>'I', 'word'=>'Ice',      'emoji'=>'🧊'],
    ['letter'=>'J', 'word'=>'Juice',    'emoji'=>'🧃'],
    ['letter'=>'K', 'word'=>'Kite',     'emoji'=>'🪁'],
    ['letter'=>'L', 'word'=>'Lion',     'emoji'=>'🦁'],
    ['letter'=>'M', 'word'=>'Mango',    'emoji'=>'🥭'],
    ['letter'=>'N', 'word'=>'Nest',     'emoji'=>'🪺'],
    ['letter'=>'O', 'word'=>'Orange',   'emoji'=>'🍊'],
    ['letter'=>'P', 'word'=>'Pig',      'emoji'=>'🐷'],
    ['letter'=>'Q', 'word'=>'Queen',    'emoji'=>'👑'],
    ['letter'=>'R', 'word'=>'Rabbit',   'emoji'=>'🐰'],
    ['letter'=>'S', 'word'=>'Sun',      'emoji'=>'☀️'],
    ['letter'=>'T', 'word'=>'Tiger',    'emoji'=>'🐯'],
    ['letter'=>'U', 'word'=>'Umbrella', 'emoji'=>'☂️'],
    ['letter'=>'V', 'word'=>'Violin',   'emoji'=>'🎻'],
    ['letter'=>'W', 'word'=>'Water',    'emoji'=>'💧'],
    ['letter'=>'X', 'word'=>'Xylophone','emoji'=>'🎼'],
    ['letter'=>'Y', 'word'=>'Yak',      'emoji'=>'🐃'],
    ['letter'=>'Z', 'word'=>'Zebra',    'emoji'=>'🦓'],
  ],
  'numbers' => [
    ['letter'=>'1',   'word'=>'One',          'emoji'=>'1️⃣'],
    ['letter'=>'2',   'word'=>'Two',          'emoji'=>'2️⃣'],
    ['letter'=>'3',   'word'=>'Three',        'emoji'=>'3️⃣'],
    ['letter'=>'4',   'word'=>'Four',         'emoji'=>'4️⃣'],
    ['letter'=>'5',   'word'=>'Five',         'emoji'=>'5️⃣'],
    ['letter'=>'6',   'word'=>'Six',          'emoji'=>'6️⃣'],
    ['letter'=>'7',   'word'=>'Seven',        'emoji'=>'7️⃣'],
    ['letter'=>'8',   'word'=>'Eight',        'emoji'=>'8️⃣'],
    ['letter'=>'9',   'word'=>'Nine',         'emoji'=>'9️⃣'],
    ['letter'=>'10',  'word'=>'Ten',          'emoji'=>'🔟'],
    ['letter'=>'11',  'word'=>'Eleven',       'emoji'=>'1️⃣1️⃣'],
    ['letter'=>'12',  'word'=>'Twelve',       'emoji'=>'1️⃣2️⃣'],
    ['letter'=>'13',  'word'=>'Thirteen',     'emoji'=>'1️⃣3️⃣'],
    ['letter'=>'14',  'word'=>'Fourteen',     'emoji'=>'1️⃣4️⃣'],
    ['letter'=>'15',  'word'=>'Fifteen',      'emoji'=>'1️⃣5️⃣'],
    ['letter'=>'16',  'word'=>'Sixteen',      'emoji'=>'1️⃣6️⃣'],
    ['letter'=>'17',  'word'=>'Seventeen',    'emoji'=>'1️⃣7️⃣'],
    ['letter'=>'18',  'word'=>'Eighteen',     'emoji'=>'1️⃣8️⃣'],
    ['letter'=>'19',  'word'=>'Nineteen',     'emoji'=>'1️⃣9️⃣'],
    ['letter'=>'20',  'word'=>'Twenty',       'emoji'=>'2️⃣0️⃣'],
    ['letter'=>'21',  'word'=>'Twenty One',   'emoji'=>'2️⃣1️⃣'],
    ['letter'=>'22',  'word'=>'Twenty Two',   'emoji'=>'2️⃣2️⃣'],
    ['letter'=>'23',  'word'=>'Twenty Three', 'emoji'=>'2️⃣3️⃣'],
    ['letter'=>'24',  'word'=>'Twenty Four',  'emoji'=>'2️⃣4️⃣'],
    ['letter'=>'25',  'word'=>'Twenty Five',  'emoji'=>'2️⃣5️⃣'],
    ['letter'=>'26',  'word'=>'Twenty Six',   'emoji'=>'2️⃣6️⃣'],
    ['letter'=>'27',  'word'=>'Twenty Seven', 'emoji'=>'2️⃣7️⃣'],
    ['letter'=>'28',  'word'=>'Twenty Eight', 'emoji'=>'2️⃣8️⃣'],
    ['letter'=>'29',  'word'=>'Twenty Nine',  'emoji'=>'2️⃣9️⃣'],
    ['letter'=>'30',  'word'=>'Thirty',       'emoji'=>'3️⃣0️⃣'],
    ['letter'=>'31',  'word'=>'Thirty One',   'emoji'=>'3️⃣1️⃣'],
    ['letter'=>'32',  'word'=>'Thirty Two',   'emoji'=>'3️⃣2️⃣'],
    ['letter'=>'33',  'word'=>'Thirty Three', 'emoji'=>'3️⃣3️⃣'],
    ['letter'=>'34',  'word'=>'Thirty Four',  'emoji'=>'3️⃣4️⃣'],
    ['letter'=>'35',  'word'=>'Thirty Five',  'emoji'=>'3️⃣5️⃣'],
    ['letter'=>'36',  'word'=>'Thirty Six',   'emoji'=>'3️⃣6️⃣'],
    ['letter'=>'37',  'word'=>'Thirty Seven', 'emoji'=>'3️⃣7️⃣'],
    ['letter'=>'38',  'word'=>'Thirty Eight', 'emoji'=>'3️⃣8️⃣'],
    ['letter'=>'39',  'word'=>'Thirty Nine',  'emoji'=>'3️⃣9️⃣'],
    ['letter'=>'40',  'word'=>'Forty',        'emoji'=>'4️⃣0️⃣'],
    ['letter'=>'41',  'word'=>'Forty One',    'emoji'=>'4️⃣1️⃣'],
    ['letter'=>'42',  'word'=>'Forty Two',    'emoji'=>'4️⃣2️⃣'],
    ['letter'=>'43',  'word'=>'Forty Three',  'emoji'=>'4️⃣3️⃣'],
    ['letter'=>'44',  'word'=>'Forty Four',   'emoji'=>'4️⃣4️⃣'],
    ['letter'=>'45',  'word'=>'Forty Five',   'emoji'=>'4️⃣5️⃣'],
    ['letter'=>'46',  'word'=>'Forty Six',    'emoji'=>'4️⃣6️⃣'],
    ['letter'=>'47',  'word'=>'Forty Seven',  'emoji'=>'4️⃣7️⃣'],
    ['letter'=>'48',  'word'=>'Forty Eight',  'emoji'=>'4️⃣8️⃣'],
    ['letter'=>'49',  'word'=>'Forty Nine',   'emoji'=>'4️⃣9️⃣'],
    ['letter'=>'50',  'word'=>'Fifty',        'emoji'=>'5️⃣0️⃣'],
    ['letter'=>'51',  'word'=>'Fifty One',    'emoji'=>'5️⃣1️⃣'],
    ['letter'=>'52',  'word'=>'Fifty Two',    'emoji'=>'5️⃣2️⃣'],
    ['letter'=>'53',  'word'=>'Fifty Three',  'emoji'=>'5️⃣3️⃣'],
    ['letter'=>'54',  'word'=>'Fifty Four',   'emoji'=>'5️⃣4️⃣'],
    ['letter'=>'55',  'word'=>'Fifty Five',   'emoji'=>'5️⃣5️⃣'],
    ['letter'=>'56',  'word'=>'Fifty Six',    'emoji'=>'5️⃣6️⃣'],
    ['letter'=>'57',  'word'=>'Fifty Seven',  'emoji'=>'5️⃣7️⃣'],
    ['letter'=>'58',  'word'=>'Fifty Eight',  'emoji'=>'5️⃣8️⃣'],
    ['letter'=>'59',  'word'=>'Fifty Nine',   'emoji'=>'5️⃣9️⃣'],
    ['letter'=>'60',  'word'=>'Sixty',        'emoji'=>'6️⃣0️⃣'],
    ['letter'=>'61',  'word'=>'Sixty One',    'emoji'=>'6️⃣1️⃣'],
    ['letter'=>'62',  'word'=>'Sixty Two',    'emoji'=>'6️⃣2️⃣'],
    ['letter'=>'63',  'word'=>'Sixty Three',  'emoji'=>'6️⃣3️⃣'],
    ['letter'=>'64',  'word'=>'Sixty Four',   'emoji'=>'6️⃣4️⃣'],
    ['letter'=>'65',  'word'=>'Sixty Five',   'emoji'=>'6️⃣5️⃣'],
    ['letter'=>'66',  'word'=>'Sixty Six',    'emoji'=>'6️⃣6️⃣'],
    ['letter'=>'67',  'word'=>'Sixty Seven',  'emoji'=>'6️⃣7️⃣'],
    ['letter'=>'68',  'word'=>'Sixty Eight',  'emoji'=>'6️⃣8️⃣'],
    ['letter'=>'69',  'word'=>'Sixty Nine',   'emoji'=>'6️⃣9️⃣'],
    ['letter'=>'70',  'word'=>'Seventy',      'emoji'=>'7️⃣0️⃣'],
    ['letter'=>'71',  'word'=>'Seventy One',  'emoji'=>'7️⃣1️⃣'],
    ['letter'=>'72',  'word'=>'Seventy Two',  'emoji'=>'7️⃣2️⃣'],
    ['letter'=>'73',  'word'=>'Seventy Three','emoji'=>'7️⃣3️⃣'],
    ['letter'=>'74',  'word'=>'Seventy Four', 'emoji'=>'7️⃣4️⃣'],
    ['letter'=>'75',  'word'=>'Seventy Five', 'emoji'=>'7️⃣5️⃣'],
    ['letter'=>'76',  'word'=>'Seventy Six',  'emoji'=>'7️⃣6️⃣'],
    ['letter'=>'77',  'word'=>'Seventy Seven','emoji'=>'7️⃣7️⃣'],
    ['letter'=>'78',  'word'=>'Seventy Eight','emoji'=>'7️⃣8️⃣'],
    ['letter'=>'79',  'word'=>'Seventy Nine', 'emoji'=>'7️⃣9️⃣'],
    ['letter'=>'80',  'word'=>'Eighty',       'emoji'=>'8️⃣0️⃣'],
    ['letter'=>'81',  'word'=>'Eighty One',   'emoji'=>'8️⃣1️⃣'],
    ['letter'=>'82',  'word'=>'Eighty Two',   'emoji'=>'8️⃣2️⃣'],
    ['letter'=>'83',  'word'=>'Eighty Three', 'emoji'=>'8️⃣3️⃣'],
    ['letter'=>'84',  'word'=>'Eighty Four',  'emoji'=>'8️⃣4️⃣'],
    ['letter'=>'85',  'word'=>'Eighty Five',  'emoji'=>'8️⃣5️⃣'],
    ['letter'=>'86',  'word'=>'Eighty Six',   'emoji'=>'8️⃣6️⃣'],
    ['letter'=>'87',  'word'=>'Eighty Seven', 'emoji'=>'8️⃣7️⃣'],
    ['letter'=>'88',  'word'=>'Eighty Eight', 'emoji'=>'8️⃣8️⃣'],
    ['letter'=>'89',  'word'=>'Eighty Nine',  'emoji'=>'8️⃣9️⃣'],
    ['letter'=>'90',  'word'=>'Ninety',       'emoji'=>'9️⃣0️⃣'],
    ['letter'=>'91',  'word'=>'Ninety One',   'emoji'=>'9️⃣1️⃣'],
    ['letter'=>'92',  'word'=>'Ninety Two',   'emoji'=>'9️⃣2️⃣'],
    ['letter'=>'93',  'word'=>'Ninety Three', 'emoji'=>'9️⃣3️⃣'],
    ['letter'=>'94',  'word'=>'Ninety Four',  'emoji'=>'9️⃣4️⃣'],
    ['letter'=>'95',  'word'=>'Ninety Five',  'emoji'=>'9️⃣5️⃣'],
    ['letter'=>'96',  'word'=>'Ninety Six',   'emoji'=>'9️⃣6️⃣'],
    ['letter'=>'97',  'word'=>'Ninety Seven', 'emoji'=>'9️⃣7️⃣'],
    ['letter'=>'98',  'word'=>'Ninety Eight', 'emoji'=>'9️⃣8️⃣'],
    ['letter'=>'99',  'word'=>'Ninety Nine',  'emoji'=>'9️⃣9️⃣'],
    ['letter'=>'100', 'word'=>'One Hundred',  'emoji'=>'💯'],
],
  'colors' => [
    ['letter'=>'🔴', 'word'=>'Red',    'emoji'=>'like an Apple'],
    ['letter'=>'🔵', 'word'=>'Blue',   'emoji'=>'like the Sky'],
    ['letter'=>'🟢', 'word'=>'Green',  'emoji'=>'like Grass'],
    ['letter'=>'🟡', 'word'=>'Yellow', 'emoji'=>'like the Sun'],
    ['letter'=>'🟠', 'word'=>'Orange', 'emoji'=>'like an Orange'],
    ['letter'=>'🟣', 'word'=>'Purple', 'emoji'=>'like Grapes'],
    ['letter'=>'⚫', 'word'=>'Black',  'emoji'=>'like the Night'],
    ['letter'=>'⬜', 'word'=>'White',  'emoji'=>'like Snow'],
  ],
  'animals' => [
    ['letter'=>'🐶', 'word'=>'Dog',      'emoji'=>'Woof woof!'],
    ['letter'=>'🐱', 'word'=>'Cat',      'emoji'=>'Meow meow!'],
    ['letter'=>'🐮', 'word'=>'Cow',      'emoji'=>'Moo moo!'],
    ['letter'=>'🐷', 'word'=>'Pig',      'emoji'=>'Oink oink!'],
    ['letter'=>'🦁', 'word'=>'Lion',     'emoji'=>'Roarrr!'],
    ['letter'=>'🐘', 'word'=>'Elephant', 'emoji'=>'Trumpet!'],
    ['letter'=>'🐸', 'word'=>'Frog',     'emoji'=>'Ribbit!'],
    ['letter'=>'🦆', 'word'=>'Duck',     'emoji'=>'Quack quack!'],
  ],
  'barakhadi' => [
    // क
    ['letter'=>'क',  'word'=>'क',  'emoji'=>'ka'],
    ['letter'=>'का', 'word'=>'का', 'emoji'=>'kaa'],
    ['letter'=>'कि', 'word'=>'कि', 'emoji'=>'ki'],
    ['letter'=>'की', 'word'=>'की', 'emoji'=>'kee'],
    ['letter'=>'कु', 'word'=>'कु', 'emoji'=>'ku'],
    ['letter'=>'कू', 'word'=>'कू', 'emoji'=>'koo'],
    ['letter'=>'के', 'word'=>'के', 'emoji'=>'ke'],
    ['letter'=>'कै', 'word'=>'कै', 'emoji'=>'kai'],
    ['letter'=>'को', 'word'=>'को', 'emoji'=>'ko'],
    ['letter'=>'कौ', 'word'=>'कौ', 'emoji'=>'kau'],
    ['letter'=>'कं', 'word'=>'कं', 'emoji'=>'kan'],
    ['letter'=>'कः', 'word'=>'कः', 'emoji'=>'kah'],

    // ख
    ['letter'=>'ख',  'word'=>'ख',  'emoji'=>'kha'],
    ['letter'=>'खा', 'word'=>'खा', 'emoji'=>'khaa'],
    ['letter'=>'खि', 'word'=>'खि', 'emoji'=>'khi'],
    ['letter'=>'खी', 'word'=>'खी', 'emoji'=>'khee'],
    ['letter'=>'खु', 'word'=>'खु', 'emoji'=>'khu'],
    ['letter'=>'खू', 'word'=>'खू', 'emoji'=>'khoo'],
    ['letter'=>'खे', 'word'=>'खे', 'emoji'=>'khe'],
    ['letter'=>'खै', 'word'=>'खै', 'emoji'=>'khai'],
    ['letter'=>'खो', 'word'=>'खो', 'emoji'=>'kho'],
    ['letter'=>'खौ', 'word'=>'खौ', 'emoji'=>'khau'],
    ['letter'=>'खं', 'word'=>'खं', 'emoji'=>'khan'],
    ['letter'=>'खः', 'word'=>'खः', 'emoji'=>'khah'],

    // ग
    ['letter'=>'ग',  'word'=>'ग',  'emoji'=>'ga'],
    ['letter'=>'गा', 'word'=>'गा', 'emoji'=>'gaa'],
    ['letter'=>'गि', 'word'=>'गि', 'emoji'=>'gi'],
    ['letter'=>'गी', 'word'=>'गी', 'emoji'=>'gee'],
    ['letter'=>'गु', 'word'=>'गु', 'emoji'=>'gu'],
    ['letter'=>'गू', 'word'=>'गू', 'emoji'=>'goo'],
    ['letter'=>'गे', 'word'=>'गे', 'emoji'=>'ge'],
    ['letter'=>'गै', 'word'=>'गै', 'emoji'=>'gai'],
    ['letter'=>'गो', 'word'=>'गो', 'emoji'=>'go'],
    ['letter'=>'गौ', 'word'=>'गौ', 'emoji'=>'gau'],
    ['letter'=>'गं', 'word'=>'गं', 'emoji'=>'gan'],
    ['letter'=>'गः', 'word'=>'गः', 'emoji'=>'gah'],

    // घ
    ['letter'=>'घ',  'word'=>'घ',  'emoji'=>'gha'],
    ['letter'=>'घा', 'word'=>'घा', 'emoji'=>'ghaa'],
    ['letter'=>'घि', 'word'=>'घि', 'emoji'=>'ghi'],
    ['letter'=>'घी', 'word'=>'घी', 'emoji'=>'ghee'],
    ['letter'=>'घु', 'word'=>'घु', 'emoji'=>'ghu'],
    ['letter'=>'घू', 'word'=>'घू', 'emoji'=>'ghoo'],
    ['letter'=>'घे', 'word'=>'घे', 'emoji'=>'ghe'],
    ['letter'=>'घै', 'word'=>'घै', 'emoji'=>'ghai'],
    ['letter'=>'घो', 'word'=>'घो', 'emoji'=>'gho'],
    ['letter'=>'घौ', 'word'=>'घौ', 'emoji'=>'ghau'],
    ['letter'=>'घं', 'word'=>'घं', 'emoji'=>'ghan'],
    ['letter'=>'घः', 'word'=>'घः', 'emoji'=>'ghah'],

    // च
    ['letter'=>'च',  'word'=>'च',  'emoji'=>'cha'],
    ['letter'=>'चा', 'word'=>'चा', 'emoji'=>'chaa'],
    ['letter'=>'चि', 'word'=>'चि', 'emoji'=>'chi'],
    ['letter'=>'ची', 'word'=>'ची', 'emoji'=>'chee'],
    ['letter'=>'चु', 'word'=>'चु', 'emoji'=>'chu'],
    ['letter'=>'चू', 'word'=>'चू', 'emoji'=>'choo'],
    ['letter'=>'चे', 'word'=>'चे', 'emoji'=>'che'],
    ['letter'=>'चै', 'word'=>'चै', 'emoji'=>'chai'],
    ['letter'=>'चो', 'word'=>'चो', 'emoji'=>'cho'],
    ['letter'=>'चौ', 'word'=>'चौ', 'emoji'=>'chau'],
    ['letter'=>'चं', 'word'=>'चं', 'emoji'=>'chan'],
    ['letter'=>'चः', 'word'=>'चः', 'emoji'=>'chah'],

    // छ
    ['letter'=>'छ',  'word'=>'छ',  'emoji'=>'chha'],
    ['letter'=>'छा', 'word'=>'छा', 'emoji'=>'chhaa'],
    ['letter'=>'छि', 'word'=>'छि', 'emoji'=>'chhi'],
    ['letter'=>'छी', 'word'=>'छी', 'emoji'=>'chhee'],
    ['letter'=>'छु', 'word'=>'छु', 'emoji'=>'chhu'],
    ['letter'=>'छू', 'word'=>'छू', 'emoji'=>'chhoo'],
    ['letter'=>'छे', 'word'=>'छे', 'emoji'=>'chhe'],
    ['letter'=>'छै', 'word'=>'छै', 'emoji'=>'chhai'],
    ['letter'=>'छो', 'word'=>'छो', 'emoji'=>'chho'],
    ['letter'=>'छौ', 'word'=>'छौ', 'emoji'=>'chhau'],
    ['letter'=>'छं', 'word'=>'छं', 'emoji'=>'chhan'],
    ['letter'=>'छः', 'word'=>'छः', 'emoji'=>'chhah'],

    // ज
    ['letter'=>'ज',  'word'=>'ज',  'emoji'=>'ja'],
    ['letter'=>'जा', 'word'=>'जा', 'emoji'=>'jaa'],
    ['letter'=>'जि', 'word'=>'जि', 'emoji'=>'ji'],
    ['letter'=>'जी', 'word'=>'जी', 'emoji'=>'jee'],
    ['letter'=>'जु', 'word'=>'जु', 'emoji'=>'ju'],
    ['letter'=>'जू', 'word'=>'जू', 'emoji'=>'joo'],
    ['letter'=>'जे', 'word'=>'जे', 'emoji'=>'je'],
    ['letter'=>'जै', 'word'=>'जै', 'emoji'=>'jai'],
    ['letter'=>'जो', 'word'=>'जो', 'emoji'=>'jo'],
    ['letter'=>'जौ', 'word'=>'जौ', 'emoji'=>'jau'],
    ['letter'=>'जं', 'word'=>'जं', 'emoji'=>'jan'],
    ['letter'=>'जः', 'word'=>'जः', 'emoji'=>'jah'],

    // झ
    ['letter'=>'झ',  'word'=>'झ',  'emoji'=>'jha'],
    ['letter'=>'झा', 'word'=>'झा', 'emoji'=>'jhaa'],
    ['letter'=>'झि', 'word'=>'झि', 'emoji'=>'jhi'],
    ['letter'=>'झी', 'word'=>'झी', 'emoji'=>'jhee'],
    ['letter'=>'झु', 'word'=>'झु', 'emoji'=>'jhu'],
    ['letter'=>'झू', 'word'=>'झू', 'emoji'=>'jhoo'],
    ['letter'=>'झे', 'word'=>'झे', 'emoji'=>'jhe'],
    ['letter'=>'झै', 'word'=>'झै', 'emoji'=>'jhai'],
    ['letter'=>'झो', 'word'=>'झो', 'emoji'=>'jho'],
    ['letter'=>'झौ', 'word'=>'झौ', 'emoji'=>'jhau'],
    ['letter'=>'झं', 'word'=>'झं', 'emoji'=>'jhan'],
    ['letter'=>'झः', 'word'=>'झः', 'emoji'=>'jhah'],

    // ट
    ['letter'=>'ट',  'word'=>'ट',  'emoji'=>'ta'],
    ['letter'=>'टा', 'word'=>'टा', 'emoji'=>'taa'],
    ['letter'=>'टि', 'word'=>'टि', 'emoji'=>'ti'],
    ['letter'=>'टी', 'word'=>'टी', 'emoji'=>'tee'],
    ['letter'=>'टु', 'word'=>'टु', 'emoji'=>'tu'],
    ['letter'=>'टू', 'word'=>'टू', 'emoji'=>'too'],
    ['letter'=>'टे', 'word'=>'टे', 'emoji'=>'te'],
    ['letter'=>'टै', 'word'=>'टै', 'emoji'=>'tai'],
    ['letter'=>'टो', 'word'=>'टो', 'emoji'=>'to'],
    ['letter'=>'टौ', 'word'=>'टौ', 'emoji'=>'tau'],
    ['letter'=>'टं', 'word'=>'टं', 'emoji'=>'tan'],
    ['letter'=>'टः', 'word'=>'टः', 'emoji'=>'tah'],

    // ठ
    ['letter'=>'ठ',  'word'=>'ठ',  'emoji'=>'tha'],
    ['letter'=>'ठा', 'word'=>'ठा', 'emoji'=>'thaa'],
    ['letter'=>'ठि', 'word'=>'ठि', 'emoji'=>'thi'],
    ['letter'=>'ठी', 'word'=>'ठी', 'emoji'=>'thee'],
    ['letter'=>'ठु', 'word'=>'ठु', 'emoji'=>'thu'],
    ['letter'=>'ठू', 'word'=>'ठू', 'emoji'=>'thoo'],
    ['letter'=>'ठे', 'word'=>'ठे', 'emoji'=>'the'],
    ['letter'=>'ठै', 'word'=>'ठै', 'emoji'=>'thai'],
    ['letter'=>'ठो', 'word'=>'ठो', 'emoji'=>'tho'],
    ['letter'=>'ठौ', 'word'=>'ठौ', 'emoji'=>'thau'],
    ['letter'=>'ठं', 'word'=>'ठं', 'emoji'=>'than'],
    ['letter'=>'ठः', 'word'=>'ठः', 'emoji'=>'thah'],

    // ड
    ['letter'=>'ड',  'word'=>'ड',  'emoji'=>'da'],
    ['letter'=>'डा', 'word'=>'डा', 'emoji'=>'daa'],
    ['letter'=>'डि', 'word'=>'डि', 'emoji'=>'di'],
    ['letter'=>'डी', 'word'=>'डी', 'emoji'=>'dee'],
    ['letter'=>'डु', 'word'=>'डु', 'emoji'=>'du'],
    ['letter'=>'डू', 'word'=>'डू', 'emoji'=>'doo'],
    ['letter'=>'डे', 'word'=>'डे', 'emoji'=>'de'],
    ['letter'=>'डै', 'word'=>'डै', 'emoji'=>'dai'],
    ['letter'=>'डो', 'word'=>'डो', 'emoji'=>'do'],
    ['letter'=>'डौ', 'word'=>'डौ', 'emoji'=>'dau'],
    ['letter'=>'डं', 'word'=>'डं', 'emoji'=>'dan'],
    ['letter'=>'डः', 'word'=>'डः', 'emoji'=>'dah'],

    // ढ
    ['letter'=>'ढ',  'word'=>'ढ',  'emoji'=>'dha'],
    ['letter'=>'ढा', 'word'=>'ढा', 'emoji'=>'dhaa'],
    ['letter'=>'ढि', 'word'=>'ढि', 'emoji'=>'dhi'],
    ['letter'=>'ढी', 'word'=>'ढी', 'emoji'=>'dhee'],
    ['letter'=>'ढु', 'word'=>'ढु', 'emoji'=>'dhu'],
    ['letter'=>'ढू', 'word'=>'ढू', 'emoji'=>'dhoo'],
    ['letter'=>'ढे', 'word'=>'ढे', 'emoji'=>'dhe'],
    ['letter'=>'ढै', 'word'=>'ढै', 'emoji'=>'dhai'],
    ['letter'=>'ढो', 'word'=>'ढो', 'emoji'=>'dho'],
    ['letter'=>'ढौ', 'word'=>'ढौ', 'emoji'=>'dhau'],
    ['letter'=>'ढं', 'word'=>'ढं', 'emoji'=>'dhan'],
    ['letter'=>'ढः', 'word'=>'ढः', 'emoji'=>'dhah'],

    // त
    ['letter'=>'त',  'word'=>'त',  'emoji'=>'ta'],
    ['letter'=>'ता', 'word'=>'ता', 'emoji'=>'taa'],
    ['letter'=>'ति', 'word'=>'ति', 'emoji'=>'ti'],
    ['letter'=>'ती', 'word'=>'ती', 'emoji'=>'tee'],
    ['letter'=>'तु', 'word'=>'तु', 'emoji'=>'tu'],
    ['letter'=>'तू', 'word'=>'तू', 'emoji'=>'too'],
    ['letter'=>'ते', 'word'=>'ते', 'emoji'=>'te'],
    ['letter'=>'तै', 'word'=>'तै', 'emoji'=>'tai'],
    ['letter'=>'तो', 'word'=>'तो', 'emoji'=>'to'],
    ['letter'=>'तौ', 'word'=>'तौ', 'emoji'=>'tau'],
    ['letter'=>'तं', 'word'=>'तं', 'emoji'=>'tan'],
    ['letter'=>'तः', 'word'=>'तः', 'emoji'=>'tah'],

    // थ
    ['letter'=>'थ',  'word'=>'थ',  'emoji'=>'tha'],
    ['letter'=>'था', 'word'=>'था', 'emoji'=>'thaa'],
    ['letter'=>'थि', 'word'=>'थि', 'emoji'=>'thi'],
    ['letter'=>'थी', 'word'=>'थी', 'emoji'=>'thee'],
    ['letter'=>'थु', 'word'=>'थु', 'emoji'=>'thu'],
    ['letter'=>'थू', 'word'=>'थू', 'emoji'=>'thoo'],
    ['letter'=>'थे', 'word'=>'थे', 'emoji'=>'the'],
    ['letter'=>'थै', 'word'=>'थै', 'emoji'=>'thai'],
    ['letter'=>'थो', 'word'=>'थो', 'emoji'=>'tho'],
    ['letter'=>'थौ', 'word'=>'थौ', 'emoji'=>'thau'],
    ['letter'=>'थं', 'word'=>'थं', 'emoji'=>'than'],
    ['letter'=>'थः', 'word'=>'थः', 'emoji'=>'thah'],

    // द
    ['letter'=>'द',  'word'=>'द',  'emoji'=>'da'],
    ['letter'=>'दा', 'word'=>'दा', 'emoji'=>'daa'],
    ['letter'=>'दि', 'word'=>'दि', 'emoji'=>'di'],
    ['letter'=>'दी', 'word'=>'दी', 'emoji'=>'dee'],
    ['letter'=>'दु', 'word'=>'दु', 'emoji'=>'du'],
    ['letter'=>'दू', 'word'=>'दू', 'emoji'=>'doo'],
    ['letter'=>'दे', 'word'=>'दे', 'emoji'=>'de'],
    ['letter'=>'दै', 'word'=>'दै', 'emoji'=>'dai'],
    ['letter'=>'दो', 'word'=>'दो', 'emoji'=>'do'],
    ['letter'=>'दौ', 'word'=>'दौ', 'emoji'=>'dau'],
    ['letter'=>'दं', 'word'=>'दं', 'emoji'=>'dan'],
    ['letter'=>'दः', 'word'=>'दः', 'emoji'=>'dah'],

    // ध
    ['letter'=>'ध',  'word'=>'ध',  'emoji'=>'dha'],
    ['letter'=>'धा', 'word'=>'धा', 'emoji'=>'dhaa'],
    ['letter'=>'धि', 'word'=>'धि', 'emoji'=>'dhi'],
    ['letter'=>'धी', 'word'=>'धी', 'emoji'=>'dhee'],
    ['letter'=>'धु', 'word'=>'धु', 'emoji'=>'dhu'],
    ['letter'=>'धू', 'word'=>'धू', 'emoji'=>'dhoo'],
    ['letter'=>'धे', 'word'=>'धे', 'emoji'=>'dhe'],
    ['letter'=>'धै', 'word'=>'धै', 'emoji'=>'dhai'],
    ['letter'=>'धो', 'word'=>'धो', 'emoji'=>'dho'],
    ['letter'=>'धौ', 'word'=>'धौ', 'emoji'=>'dhau'],
    ['letter'=>'धं', 'word'=>'धं', 'emoji'=>'dhan'],
    ['letter'=>'धः', 'word'=>'धः', 'emoji'=>'dhah'],

    // न
    ['letter'=>'न',  'word'=>'न',  'emoji'=>'na'],
    ['letter'=>'ना', 'word'=>'ना', 'emoji'=>'naa'],
    ['letter'=>'नि', 'word'=>'नि', 'emoji'=>'ni'],
    ['letter'=>'नी', 'word'=>'नी', 'emoji'=>'nee'],
    ['letter'=>'नु', 'word'=>'नु', 'emoji'=>'nu'],
    ['letter'=>'नू', 'word'=>'नू', 'emoji'=>'noo'],
    ['letter'=>'ने', 'word'=>'ने', 'emoji'=>'ne'],
    ['letter'=>'नै', 'word'=>'नै', 'emoji'=>'nai'],
    ['letter'=>'नो', 'word'=>'नो', 'emoji'=>'no'],
    ['letter'=>'नौ', 'word'=>'नौ', 'emoji'=>'nau'],
    ['letter'=>'नं', 'word'=>'नं', 'emoji'=>'nan'],
    ['letter'=>'नः', 'word'=>'नः', 'emoji'=>'nah'],

    // प
    ['letter'=>'प',  'word'=>'प',  'emoji'=>'pa'],
    ['letter'=>'पा', 'word'=>'पा', 'emoji'=>'paa'],
    ['letter'=>'पि', 'word'=>'पि', 'emoji'=>'pi'],
    ['letter'=>'पी', 'word'=>'पी', 'emoji'=>'pee'],
    ['letter'=>'पु', 'word'=>'पु', 'emoji'=>'pu'],
    ['letter'=>'पू', 'word'=>'पू', 'emoji'=>'poo'],
    ['letter'=>'पे', 'word'=>'पे', 'emoji'=>'pe'],
    ['letter'=>'पै', 'word'=>'पै', 'emoji'=>'pai'],
    ['letter'=>'पो', 'word'=>'पो', 'emoji'=>'po'],
    ['letter'=>'पौ', 'word'=>'पौ', 'emoji'=>'pau'],
    ['letter'=>'पं', 'word'=>'पं', 'emoji'=>'pan'],
    ['letter'=>'पः', 'word'=>'पः', 'emoji'=>'pah'],

    // फ
    ['letter'=>'फ',  'word'=>'फ',  'emoji'=>'pha'],
    ['letter'=>'फा', 'word'=>'फा', 'emoji'=>'phaa'],
    ['letter'=>'फि', 'word'=>'फि', 'emoji'=>'phi'],
    ['letter'=>'फी', 'word'=>'फी', 'emoji'=>'phee'],
    ['letter'=>'फु', 'word'=>'फु', 'emoji'=>'phu'],
    ['letter'=>'फू', 'word'=>'फू', 'emoji'=>'phoo'],
    ['letter'=>'फे', 'word'=>'फे', 'emoji'=>'phe'],
    ['letter'=>'फै', 'word'=>'फै', 'emoji'=>'phai'],
    ['letter'=>'फो', 'word'=>'फो', 'emoji'=>'pho'],
    ['letter'=>'फौ', 'word'=>'फौ', 'emoji'=>'phau'],
    ['letter'=>'फं', 'word'=>'फं', 'emoji'=>'phan'],
    ['letter'=>'फः', 'word'=>'फः', 'emoji'=>'phah'],

    // ब
    ['letter'=>'ब',  'word'=>'ब',  'emoji'=>'ba'],
    ['letter'=>'बा', 'word'=>'बा', 'emoji'=>'baa'],
    ['letter'=>'बि', 'word'=>'बि', 'emoji'=>'bi'],
    ['letter'=>'बी', 'word'=>'बी', 'emoji'=>'bee'],
    ['letter'=>'बु', 'word'=>'बु', 'emoji'=>'bu'],
    ['letter'=>'बू', 'word'=>'बू', 'emoji'=>'boo'],
    ['letter'=>'बे', 'word'=>'बे', 'emoji'=>'be'],
    ['letter'=>'बै', 'word'=>'बै', 'emoji'=>'bai'],
    ['letter'=>'बो', 'word'=>'बो', 'emoji'=>'bo'],
    ['letter'=>'बौ', 'word'=>'बौ', 'emoji'=>'bau'],
    ['letter'=>'बं', 'word'=>'बं', 'emoji'=>'ban'],
    ['letter'=>'बः', 'word'=>'बः', 'emoji'=>'bah'],

    // भ
    ['letter'=>'भ',  'word'=>'भ',  'emoji'=>'bha'],
    ['letter'=>'भा', 'word'=>'भा', 'emoji'=>'bhaa'],
    ['letter'=>'भि', 'word'=>'भि', 'emoji'=>'bhi'],
    ['letter'=>'भी', 'word'=>'भी', 'emoji'=>'bhee'],
    ['letter'=>'भु', 'word'=>'भु', 'emoji'=>'bhu'],
    ['letter'=>'भू', 'word'=>'भू', 'emoji'=>'bhoo'],
    ['letter'=>'भे', 'word'=>'भे', 'emoji'=>'bhe'],
    ['letter'=>'भै', 'word'=>'भै', 'emoji'=>'bhai'],
    ['letter'=>'भो', 'word'=>'भो', 'emoji'=>'bho'],
    ['letter'=>'भौ', 'word'=>'भौ', 'emoji'=>'bhau'],
    ['letter'=>'भं', 'word'=>'भं', 'emoji'=>'bhan'],
    ['letter'=>'भः', 'word'=>'भः', 'emoji'=>'bhah'],

    // म
    ['letter'=>'म',  'word'=>'म',  'emoji'=>'ma'],
    ['letter'=>'मा', 'word'=>'मा', 'emoji'=>'maa'],
    ['letter'=>'मि', 'word'=>'मि', 'emoji'=>'mi'],
    ['letter'=>'मी', 'word'=>'मी', 'emoji'=>'mee'],
    ['letter'=>'मु', 'word'=>'मु', 'emoji'=>'mu'],
    ['letter'=>'मू', 'word'=>'मू', 'emoji'=>'moo'],
    ['letter'=>'मे', 'word'=>'मे', 'emoji'=>'me'],
    ['letter'=>'मै', 'word'=>'मै', 'emoji'=>'mai'],
    ['letter'=>'मो', 'word'=>'मो', 'emoji'=>'mo'],
    ['letter'=>'मौ', 'word'=>'मौ', 'emoji'=>'mau'],
    ['letter'=>'मं', 'word'=>'मं', 'emoji'=>'man'],
    ['letter'=>'मः', 'word'=>'मः', 'emoji'=>'mah'],

    // य
    ['letter'=>'य',  'word'=>'य',  'emoji'=>'ya'],
    ['letter'=>'या', 'word'=>'या', 'emoji'=>'yaa'],
    ['letter'=>'यि', 'word'=>'यि', 'emoji'=>'yi'],
    ['letter'=>'यी', 'word'=>'यी', 'emoji'=>'yee'],
    ['letter'=>'यु', 'word'=>'यु', 'emoji'=>'yu'],
    ['letter'=>'यू', 'word'=>'यू', 'emoji'=>'yoo'],
    ['letter'=>'ये', 'word'=>'ये', 'emoji'=>'ye'],
    ['letter'=>'यै', 'word'=>'यै', 'emoji'=>'yai'],
    ['letter'=>'यो', 'word'=>'यो', 'emoji'=>'yo'],
    ['letter'=>'यौ', 'word'=>'यौ', 'emoji'=>'yau'],
    ['letter'=>'यं', 'word'=>'यं', 'emoji'=>'yan'],
    ['letter'=>'यः', 'word'=>'यः', 'emoji'=>'yah'],

    // र
    ['letter'=>'र',  'word'=>'र',  'emoji'=>'ra'],
    ['letter'=>'रा', 'word'=>'रा', 'emoji'=>'raa'],
    ['letter'=>'रि', 'word'=>'रि', 'emoji'=>'ri'],
    ['letter'=>'री', 'word'=>'री', 'emoji'=>'ree'],
    ['letter'=>'रु', 'word'=>'रु', 'emoji'=>'ru'],
    ['letter'=>'रू', 'word'=>'रू', 'emoji'=>'roo'],
    ['letter'=>'रे', 'word'=>'रे', 'emoji'=>'re'],
    ['letter'=>'रै', 'word'=>'रै', 'emoji'=>'rai'],
    ['letter'=>'रो', 'word'=>'रो', 'emoji'=>'ro'],
    ['letter'=>'रौ', 'word'=>'रौ', 'emoji'=>'rau'],
    ['letter'=>'रं', 'word'=>'रं', 'emoji'=>'ran'],
    ['letter'=>'रः', 'word'=>'रः', 'emoji'=>'rah'],

    // ल
    ['letter'=>'ल',  'word'=>'ल',  'emoji'=>'la'],
    ['letter'=>'ला', 'word'=>'ला', 'emoji'=>'laa'],
    ['letter'=>'लि', 'word'=>'लि', 'emoji'=>'li'],
    ['letter'=>'ली', 'word'=>'ली', 'emoji'=>'lee'],
    ['letter'=>'लु', 'word'=>'लु', 'emoji'=>'lu'],
    ['letter'=>'लू', 'word'=>'लू', 'emoji'=>'loo'],
    ['letter'=>'ले', 'word'=>'ले', 'emoji'=>'le'],
    ['letter'=>'लै', 'word'=>'लै', 'emoji'=>'lai'],
    ['letter'=>'लो', 'word'=>'लो', 'emoji'=>'lo'],
    ['letter'=>'लौ', 'word'=>'लौ', 'emoji'=>'lau'],
    ['letter'=>'लं', 'word'=>'लं', 'emoji'=>'lan'],
    ['letter'=>'लः', 'word'=>'लः', 'emoji'=>'lah'],

    // व
    ['letter'=>'व',  'word'=>'व',  'emoji'=>'wa'],
    ['letter'=>'वा', 'word'=>'वा', 'emoji'=>'waa'],
    ['letter'=>'वि', 'word'=>'वि', 'emoji'=>'wi'],
    ['letter'=>'वी', 'word'=>'वी', 'emoji'=>'wee'],
    ['letter'=>'वु', 'word'=>'वु', 'emoji'=>'wu'],
    ['letter'=>'वू', 'word'=>'वू', 'emoji'=>'woo'],
    ['letter'=>'वे', 'word'=>'वे', 'emoji'=>'we'],
    ['letter'=>'वै', 'word'=>'वै', 'emoji'=>'wai'],
    ['letter'=>'वो', 'word'=>'वो', 'emoji'=>'wo'],
    ['letter'=>'वौ', 'word'=>'वौ', 'emoji'=>'wau'],
    ['letter'=>'वं', 'word'=>'वं', 'emoji'=>'wan'],
    ['letter'=>'वः', 'word'=>'वः', 'emoji'=>'wah'],

    // श
    ['letter'=>'श',  'word'=>'श',  'emoji'=>'sha'],
    ['letter'=>'शा', 'word'=>'शा', 'emoji'=>'shaa'],
    ['letter'=>'शि', 'word'=>'शि', 'emoji'=>'shi'],
    ['letter'=>'शी', 'word'=>'शी', 'emoji'=>'shee'],
    ['letter'=>'शु', 'word'=>'शु', 'emoji'=>'shu'],
    ['letter'=>'शू', 'word'=>'शू', 'emoji'=>'shoo'],
    ['letter'=>'शे', 'word'=>'शे', 'emoji'=>'she'],
    ['letter'=>'शै', 'word'=>'शै', 'emoji'=>'shai'],
    ['letter'=>'शो', 'word'=>'शो', 'emoji'=>'sho'],
    ['letter'=>'शौ', 'word'=>'शौ', 'emoji'=>'shau'],
    ['letter'=>'शं', 'word'=>'शं', 'emoji'=>'shan'],
    ['letter'=>'शः', 'word'=>'शः', 'emoji'=>'shah'],

    // स
    ['letter'=>'स',  'word'=>'स',  'emoji'=>'sa'],
    ['letter'=>'सा', 'word'=>'सा', 'emoji'=>'saa'],
    ['letter'=>'सि', 'word'=>'सि', 'emoji'=>'si'],
    ['letter'=>'सी', 'word'=>'सी', 'emoji'=>'see'],
    ['letter'=>'सु', 'word'=>'सु', 'emoji'=>'su'],
    ['letter'=>'सू', 'word'=>'सू', 'emoji'=>'soo'],
    ['letter'=>'से', 'word'=>'से', 'emoji'=>'se'],
    ['letter'=>'सै', 'word'=>'सै', 'emoji'=>'sai'],
    ['letter'=>'सो', 'word'=>'सो', 'emoji'=>'so'],
    ['letter'=>'सौ', 'word'=>'सौ', 'emoji'=>'sau'],
    ['letter'=>'सं', 'word'=>'सं', 'emoji'=>'san'],
    ['letter'=>'सः', 'word'=>'सः', 'emoji'=>'sah'],

    // ह
    ['letter'=>'ह',  'word'=>'ह',  'emoji'=>'ha'],
    ['letter'=>'हा', 'word'=>'हा', 'emoji'=>'haa'],
    ['letter'=>'हि', 'word'=>'हि', 'emoji'=>'hi'],
    ['letter'=>'ही', 'word'=>'ही', 'emoji'=>'hee'],
    ['letter'=>'हु', 'word'=>'हु', 'emoji'=>'hu'],
    ['letter'=>'हू', 'word'=>'हू', 'emoji'=>'hoo'],
    ['letter'=>'हे', 'word'=>'हे', 'emoji'=>'he'],
    ['letter'=>'है', 'word'=>'है', 'emoji'=>'hai'],
    ['letter'=>'हो', 'word'=>'हो', 'emoji'=>'ho'],
    ['letter'=>'हौ', 'word'=>'हौ', 'emoji'=>'hau'],
    ['letter'=>'हं', 'word'=>'हं', 'emoji'=>'han'],
    ['letter'=>'हः', 'word'=>'हः', 'emoji'=>'hah'],

    // क्ष
    ['letter'=>'क्ष',  'word'=>'क्ष',  'emoji'=>'ksha'],
    ['letter'=>'क्षा', 'word'=>'क्षा', 'emoji'=>'kshaa'],
    ['letter'=>'क्षि', 'word'=>'क्षि', 'emoji'=>'kshi'],
    ['letter'=>'क्षी', 'word'=>'क्षी', 'emoji'=>'kshee'],
    ['letter'=>'क्षु', 'word'=>'क्षु', 'emoji'=>'kshu'],
    ['letter'=>'क्षे', 'word'=>'क्षे', 'emoji'=>'kshe'],
    ['letter'=>'क्षो', 'word'=>'क्षो', 'emoji'=>'ksho'],

    // त्र
    ['letter'=>'त्र',  'word'=>'त्र',  'emoji'=>'tra'],
    ['letter'=>'त्रा', 'word'=>'त्रा', 'emoji'=>'traa'],
    ['letter'=>'त्रि', 'word'=>'त्रि', 'emoji'=>'tri'],
    ['letter'=>'त्री', 'word'=>'त्री', 'emoji'=>'tree'],
    ['letter'=>'त्रु', 'word'=>'त्रु', 'emoji'=>'tru'],
    ['letter'=>'त्रे', 'word'=>'त्रे', 'emoji'=>'tre'],
    ['letter'=>'त्रो', 'word'=>'त्रो', 'emoji'=>'tro'],

    // ज्ञ
    ['letter'=>'ज्ञ',  'word'=>'ज्ञ',  'emoji'=>'gya'],
    ['letter'=>'ज्ञा', 'word'=>'ज्ञा', 'emoji'=>'gyaa'],
    ['letter'=>'ज्ञि', 'word'=>'ज्ञि', 'emoji'=>'gyi'],
    ['letter'=>'ज्ञी', 'word'=>'ज्ञी', 'emoji'=>'gyee'],
    ['letter'=>'ज्ञु', 'word'=>'ज्ञु', 'emoji'=>'gyu'],
    ['letter'=>'ज्ञे', 'word'=>'ज्ञे', 'emoji'=>'gye'],
    ['letter'=>'ज्ञो', 'word'=>'ज्ञो', 'emoji'=>'gyo'],
],

'body' => [
    ['letter'=>'👁️',  'word'=>'Eye',    'emoji'=>'आँखा'],
    ['letter'=>'👃',  'word'=>'Nose',   'emoji'=>'नाक'],
    ['letter'=>'👄',  'word'=>'Mouth',  'emoji'=>'मुख'],
    ['letter'=>'👂',  'word'=>'Ear',    'emoji'=>'कान'],
    ['letter'=>'✋',  'word'=>'Hand',   'emoji'=>'हात'],
    ['letter'=>'🦶',  'word'=>'Foot',   'emoji'=>'खुट्टा'],
    ['letter'=>'🦷',  'word'=>'Teeth',  'emoji'=>'दाँत'],
    ['letter'=>'💇',  'word'=>'Head',   'emoji'=>'टाउको'],
    ['letter'=>'🫀',  'word'=>'Heart',  'emoji'=>'मुटु'],
    ['letter'=>'🦴',  'word'=>'Bone',   'emoji'=>'हड्डी'],
    ['letter'=>'💪',  'word'=>'Arm',    'emoji'=>'बाहु'],
    ['letter'=>'🦵',  'word'=>'Leg',    'emoji'=>'खुट्टा'],
    ['letter'=>'🫁',  'word'=>'Lungs',  'emoji'=>'फोक्सो'],
    ['letter'=>'🧠',  'word'=>'Brain',  'emoji'=>'दिमाग'],
    ['letter'=>'👅',  'word'=>'Tongue', 'emoji'=>'जिब्रो'],
],

'domestic' => [
    ['letter'=>'🐄', 'word'=>'Cow',     'emoji'=>'गाई - Moo!'],
    ['letter'=>'🐐', 'word'=>'Goat',    'emoji'=>'बाख्रा - Meh!'],
    ['letter'=>'🐑', 'word'=>'Sheep',   'emoji'=>'भेडा - Baa!'],
    ['letter'=>'🐖', 'word'=>'Pig',     'emoji'=>'सुँगुर - Oink!'],
    ['letter'=>'🐓', 'word'=>'Chicken', 'emoji'=>'कुखुरा - Cluck!'],
    ['letter'=>'🐕', 'word'=>'Dog',     'emoji'=>'कुकुर - Woof!'],
    ['letter'=>'🐈', 'word'=>'Cat',     'emoji'=>'बिरालो - Meow!'],
    ['letter'=>'🐇', 'word'=>'Rabbit',  'emoji'=>'खरायो - Squeak!'],
    ['letter'=>'🐴', 'word'=>'Horse',   'emoji'=>'घोडा - Neigh!'],
    ['letter'=>'🫏', 'word'=>'Donkey',  'emoji'=>'गधा - Hee-haw!'],
    ['letter'=>'🦆', 'word'=>'Duck',    'emoji'=>'हाँस - Quack!'],
    ['letter'=>'🐃', 'word'=>'Buffalo', 'emoji'=>'भैंसी - Moo!'],
    ['letter'=>'🐪', 'word'=>'Camel',   'emoji'=>'उँट - Groan!'],
    ['letter'=>'🐘', 'word'=>'Elephant','emoji'=>'हात्ती - Trumpet!'],
],

'wild' => [
    ['letter'=>'🦁', 'word'=>'Lion',      'emoji'=>'सिंह - Roarrr!'],
    ['letter'=>'🐯', 'word'=>'Tiger',     'emoji'=>'बाघ - Growl!'],
    ['letter'=>'🐻', 'word'=>'Bear',      'emoji'=>'भालु - Growl!'],
    ['letter'=>'🦊', 'word'=>'Fox',       'emoji'=>'फ्याउरो - Bark!'],
    ['letter'=>'🐺', 'word'=>'Wolf',      'emoji'=>'ब्वाँसो - Howl!'],
    ['letter'=>'🦒', 'word'=>'Giraffe',   'emoji'=>'जिराफ - Silent!'],
    ['letter'=>'🦓', 'word'=>'Zebra',     'emoji'=>'जेब्रा - Bark!'],
    ['letter'=>'🐆', 'word'=>'Leopard',   'emoji'=>'चितुवा - Growl!'],
    ['letter'=>'🦏', 'word'=>'Rhino',     'emoji'=>'गैंडा - Grunt!'],
    ['letter'=>'🦛', 'word'=>'Hippo',     'emoji'=>'दरियाई घोडा!'],
    ['letter'=>'🐊', 'word'=>'Crocodile', 'emoji'=>'गोही - Hiss!'],
    ['letter'=>'🦅', 'word'=>'Eagle',     'emoji'=>'चील - Screech!'],
    ['letter'=>'🐍', 'word'=>'Snake',     'emoji'=>'साप - Hiss!'],
    ['letter'=>'🦋', 'word'=>'Butterfly', 'emoji'=>'पुतली - Flutter!'],
    ['letter'=>'🐘', 'word'=>'Elephant',  'emoji'=>'हात्ती - Trumpet!'],
    ['letter'=>'🦍', 'word'=>'Gorilla',   'emoji'=>'गोरिल्ला - Roar!'],
],

'water' => [
    ['letter'=>'🐟', 'word'=>'Fish',      'emoji'=>'माछा'],
    ['letter'=>'🐠', 'word'=>'Clownfish', 'emoji'=>'रंगीन माछा'],
    ['letter'=>'🐡', 'word'=>'Pufferfish','emoji'=>'फुग्ने माछा'],
    ['letter'=>'🦈', 'word'=>'Shark',     'emoji'=>'सार्क - Chomp!'],
    ['letter'=>'🐬', 'word'=>'Dolphin',   'emoji'=>'डल्फिन - Click!'],
    ['letter'=>'🐳', 'word'=>'Whale',     'emoji'=>'ह्वेल - Splash!'],
    ['letter'=>'🐙', 'word'=>'Octopus',   'emoji'=>'अक्टोपस'],
    ['letter'=>'🦑', 'word'=>'Squid',     'emoji'=>'स्क्विड'],
    ['letter'=>'🦞', 'word'=>'Lobster',   'emoji'=>'लबस्टर'],
    ['letter'=>'🦀', 'word'=>'Crab',      'emoji'=>'गँगटो'],
    ['letter'=>'🐢', 'word'=>'Turtle',    'emoji'=>'कछुवा'],
    ['letter'=>'🦭', 'word'=>'Seal',      'emoji'=>'सिल'],
    ['letter'=>'🐸', 'word'=>'Frog',      'emoji'=>'भ्यागुतो - Ribbit!'],
    ['letter'=>'🦦', 'word'=>'Otter',     'emoji'=>'ओटर'],
    ['letter'=>'🪼', 'word'=>'Jellyfish', 'emoji'=>'जेलीफिस'],
],
'nepali' => [
    ['letter'=>'क', 'word'=>'कलम',   'emoji'=>'✏️'],
    ['letter'=>'ख', 'word'=>'खरायो', 'emoji'=>'🐰'],
    ['letter'=>'ग', 'word'=>'गाई',   'emoji'=>'🐮'],
    ['letter'=>'घ', 'word'=>'घर',    'emoji'=>'🏠'],
    ['letter'=>'ङ', 'word'=>'ङ',     'emoji'=>'🔤'],
    ['letter'=>'च', 'word'=>'चरा',   'emoji'=>'🐦'],
    ['letter'=>'छ', 'word'=>'छाता',  'emoji'=>'☂️'],
    ['letter'=>'ज', 'word'=>'जहाज',  'emoji'=>'✈️'],
    ['letter'=>'झ', 'word'=>'झ्याल', 'emoji'=>'🪟'],
    ['letter'=>'ञ', 'word'=>'ञ',     'emoji'=>'🔤'],
    ['letter'=>'ट', 'word'=>'टोपी',  'emoji'=>'🎩'],
    ['letter'=>'ठ', 'word'=>'ठाउँ',  'emoji'=>'📍'],
    ['letter'=>'ड', 'word'=>'डमरु',  'emoji'=>'🥁'],
    ['letter'=>'ढ', 'word'=>'ढोका',  'emoji'=>'🚪'],
    ['letter'=>'ण', 'word'=>'ण',     'emoji'=>'🔤'],
    ['letter'=>'त', 'word'=>'तरकारी','emoji'=>'🥦'],
    ['letter'=>'थ', 'word'=>'थैली',  'emoji'=>'👜'],
    ['letter'=>'द', 'word'=>'दाँत',  'emoji'=>'🦷'],
    ['letter'=>'ध', 'word'=>'धनुष',  'emoji'=>'🏹'],
    ['letter'=>'न', 'word'=>'नाक',   'emoji'=>'👃'],
    ['letter'=>'प', 'word'=>'पानी',  'emoji'=>'💧'],
    ['letter'=>'फ', 'word'=>'फूल',   'emoji'=>'🌸'],
    ['letter'=>'ब', 'word'=>'बाख्रा','emoji'=>'🐐'],
    ['letter'=>'भ', 'word'=>'भालु',  'emoji'=>'🐻'],
    ['letter'=>'म', 'word'=>'माछा',  'emoji'=>'🐟'],
    ['letter'=>'य', 'word'=>'यात्रा','emoji'=>'🚌'],
    ['letter'=>'र', 'word'=>'रूख',   'emoji'=>'🌳'],
    ['letter'=>'ल', 'word'=>'लुगा',  'emoji'=>'👕'],
    ['letter'=>'व', 'word'=>'वायु',  'emoji'=>'💨'],
    ['letter'=>'श', 'word'=>'शेर',   'emoji'=>'🦁'],
    ['letter'=>'ष', 'word'=>'षट्कोण','emoji'=>'⬡'],
    ['letter'=>'स', 'word'=>'सूर्य', 'emoji'=>'☀️'],
    ['letter'=>'ह', 'word'=>'हात',   'emoji'=>'✋'],
    ['letter'=>'क्ष','word'=>'क्षेत्र','emoji'=>'🗺️'],
    ['letter'=>'त्र','word'=>'त्रिभुज','emoji'=>'🔺'],
    ['letter'=>'ज्ञ','word'=>'ज्ञान', 'emoji'=>'📚'],
],
'nepali_numbers' => [
    ['letter'=>'१',  'word'=>'एक',         'emoji'=>'एक - One'],
    ['letter'=>'२',  'word'=>'दुई',         'emoji'=>'दुई - Two'],
    ['letter'=>'३',  'word'=>'तीन',         'emoji'=>'तीन - Three'],
    ['letter'=>'४',  'word'=>'चार',         'emoji'=>'चार - Four'],
    ['letter'=>'५',  'word'=>'पाँच',        'emoji'=>'पाँच - Five'],
    ['letter'=>'६',  'word'=>'छ',           'emoji'=>'छ - Six'],
    ['letter'=>'७',  'word'=>'सात',         'emoji'=>'सात - Seven'],
    ['letter'=>'८',  'word'=>'आठ',          'emoji'=>'आठ - Eight'],
    ['letter'=>'९',  'word'=>'नौ',          'emoji'=>'नौ - Nine'],
    ['letter'=>'१०', 'word'=>'दश',          'emoji'=>'दश - Ten'],
    ['letter'=>'११', 'word'=>'एघार',        'emoji'=>'एघार - Eleven'],
    ['letter'=>'१२', 'word'=>'बाह्र',       'emoji'=>'बाह्र - Twelve'],
    ['letter'=>'१३', 'word'=>'तेह्र',       'emoji'=>'तेह्र - Thirteen'],
    ['letter'=>'१४', 'word'=>'चौध',         'emoji'=>'चौध - Fourteen'],
    ['letter'=>'१५', 'word'=>'पन्ध्र',      'emoji'=>'पन्ध्र - Fifteen'],
    ['letter'=>'१६', 'word'=>'सोह्र',       'emoji'=>'सोह्र - Sixteen'],
    ['letter'=>'१७', 'word'=>'सत्र',        'emoji'=>'सत्र - Seventeen'],
    ['letter'=>'१८', 'word'=>'अठार',        'emoji'=>'अठार - Eighteen'],
    ['letter'=>'१९', 'word'=>'उन्नाइस',     'emoji'=>'उन्नाइस - Nineteen'],
    ['letter'=>'२०', 'word'=>'बीस',         'emoji'=>'बीस - Twenty'],
    ['letter'=>'२१', 'word'=>'एक्काइस',     'emoji'=>'एक्काइस - Twenty One'],
    ['letter'=>'२२', 'word'=>'बाइस',        'emoji'=>'बाइस - Twenty Two'],
    ['letter'=>'२३', 'word'=>'तेइस',        'emoji'=>'तेइस - Twenty Three'],
    ['letter'=>'२४', 'word'=>'चौबिस',       'emoji'=>'चौबिस - Twenty Four'],
    ['letter'=>'२५', 'word'=>'पच्चीस',      'emoji'=>'पच्चीस - Twenty Five'],
    ['letter'=>'२६', 'word'=>'छब्बिस',      'emoji'=>'छब्बिस - Twenty Six'],
    ['letter'=>'२७', 'word'=>'सत्ताइस',     'emoji'=>'सत्ताइस - Twenty Seven'],
    ['letter'=>'२८', 'word'=>'अट्ठाइस',     'emoji'=>'अट्ठाइस - Twenty Eight'],
    ['letter'=>'२९', 'word'=>'उनन्तीस',     'emoji'=>'उनन्तीस - Twenty Nine'],
    ['letter'=>'३०', 'word'=>'तीस',         'emoji'=>'तीस - Thirty'],
    ['letter'=>'३१', 'word'=>'एकतीस',       'emoji'=>'एकतीस - Thirty One'],
    ['letter'=>'३२', 'word'=>'बत्तीस',      'emoji'=>'बत्तीस - Thirty Two'],
    ['letter'=>'३३', 'word'=>'तेत्तीस',     'emoji'=>'तेत्तीस - Thirty Three'],
    ['letter'=>'३४', 'word'=>'चौतीस',       'emoji'=>'चौतीस - Thirty Four'],
    ['letter'=>'३५', 'word'=>'पैंतीस',      'emoji'=>'पैंतीस - Thirty Five'],
    ['letter'=>'३६', 'word'=>'छत्तीस',      'emoji'=>'छत्तीस - Thirty Six'],
    ['letter'=>'३७', 'word'=>'सैंतीस',      'emoji'=>'सैंतीस - Thirty Seven'],
    ['letter'=>'३८', 'word'=>'अड्तीस',      'emoji'=>'अड्तीस - Thirty Eight'],
    ['letter'=>'३९', 'word'=>'उनन्चालीस',   'emoji'=>'उनन्चालीस - Thirty Nine'],
    ['letter'=>'४०', 'word'=>'चालीस',       'emoji'=>'चालीस - Forty'],
    ['letter'=>'४१', 'word'=>'एकचालीस',     'emoji'=>'एकचालीस - Forty One'],
    ['letter'=>'४२', 'word'=>'बयालीस',      'emoji'=>'बयालीस - Forty Two'],
    ['letter'=>'४३', 'word'=>'त्रिचालीस',   'emoji'=>'त्रिचालीस - Forty Three'],
    ['letter'=>'४४', 'word'=>'चवालीस',      'emoji'=>'चवालीस - Forty Four'],
    ['letter'=>'४५', 'word'=>'पैंतालीस',    'emoji'=>'पैंतालीस - Forty Five'],
    ['letter'=>'४६', 'word'=>'छयालीस',      'emoji'=>'छयालीस - Forty Six'],
    ['letter'=>'४७', 'word'=>'सत्चालीस',    'emoji'=>'सत्चालीस - Forty Seven'],
    ['letter'=>'४८', 'word'=>'अड्चालीस',    'emoji'=>'अड्चालीस - Forty Eight'],
    ['letter'=>'४९', 'word'=>'उनन्पचास',    'emoji'=>'उनन्पचास - Forty Nine'],
    ['letter'=>'५०', 'word'=>'पचास',        'emoji'=>'पचास - Fifty'],
    ['letter'=>'५१', 'word'=>'एकाउन्न',     'emoji'=>'एकाउन्न - Fifty One'],
    ['letter'=>'५२', 'word'=>'बाउन्न',      'emoji'=>'बाउन्न - Fifty Two'],
    ['letter'=>'५३', 'word'=>'त्रिपन्न',    'emoji'=>'त्रिपन्न - Fifty Three'],
    ['letter'=>'५४', 'word'=>'चउन्न',       'emoji'=>'चउन्न - Fifty Four'],
    ['letter'=>'५५', 'word'=>'पचपन्न',      'emoji'=>'पचपन्न - Fifty Five'],
    ['letter'=>'५६', 'word'=>'छपन्न',       'emoji'=>'छपन्न - Fifty Six'],
    ['letter'=>'५७', 'word'=>'सन्ताउन्न',   'emoji'=>'सन्ताउन्न - Fifty Seven'],
    ['letter'=>'५८', 'word'=>'अन्ठाउन्न',   'emoji'=>'अन्ठाउन्न - Fifty Eight'],
    ['letter'=>'५९', 'word'=>'उनन्साठी',    'emoji'=>'उनन्साठी - Fifty Nine'],
    ['letter'=>'६०', 'word'=>'साठी',        'emoji'=>'साठी - Sixty'],
    ['letter'=>'६१', 'word'=>'एकसट्ठी',     'emoji'=>'एकसट्ठी - Sixty One'],
    ['letter'=>'६२', 'word'=>'बयसट्ठी',     'emoji'=>'बयसट्ठी - Sixty Two'],
    ['letter'=>'६३', 'word'=>'त्रिसट्ठी',   'emoji'=>'त्रिसट्ठी - Sixty Three'],
    ['letter'=>'६४', 'word'=>'चौसट्ठी',     'emoji'=>'चौसट्ठी - Sixty Four'],
    ['letter'=>'६५', 'word'=>'पैसट्ठी',     'emoji'=>'पैसट्ठी - Sixty Five'],
    ['letter'=>'६६', 'word'=>'छयसट्ठी',     'emoji'=>'छयसट्ठी - Sixty Six'],
    ['letter'=>'६७', 'word'=>'सतसट्ठी',     'emoji'=>'सतसट्ठी - Sixty Seven'],
    ['letter'=>'६८', 'word'=>'अड्सट्ठी',    'emoji'=>'अड्सट्ठी - Sixty Eight'],
    ['letter'=>'६९', 'word'=>'उनन्सत्तरी',  'emoji'=>'उनन्सत्तरी - Sixty Nine'],
    ['letter'=>'७०', 'word'=>'सत्तरी',      'emoji'=>'सत्तरी - Seventy'],
    ['letter'=>'७१', 'word'=>'एकहत्तर',     'emoji'=>'एकहत्तर - Seventy One'],
    ['letter'=>'७२', 'word'=>'बहत्तर',      'emoji'=>'बहत्तर - Seventy Two'],
    ['letter'=>'७३', 'word'=>'त्रिहत्तर',   'emoji'=>'त्रिहत्तर - Seventy Three'],
    ['letter'=>'७४', 'word'=>'चौहत्तर',     'emoji'=>'चौहत्तर - Seventy Four'],
    ['letter'=>'७५', 'word'=>'पचहत्तर',     'emoji'=>'पचहत्तर - Seventy Five'],
    ['letter'=>'७६', 'word'=>'छयहत्तर',     'emoji'=>'छयहत्तर - Seventy Six'],
    ['letter'=>'७७', 'word'=>'सतहत्तर',     'emoji'=>'सतहत्तर - Seventy Seven'],
    ['letter'=>'७८', 'word'=>'अठहत्तर',     'emoji'=>'अठहत्तर - Seventy Eight'],
    ['letter'=>'७९', 'word'=>'उनासी',       'emoji'=>'उनासी - Seventy Nine'],
    ['letter'=>'८०', 'word'=>'असी',         'emoji'=>'असी - Eighty'],
    ['letter'=>'८१', 'word'=>'एकासी',       'emoji'=>'एकासी - Eighty One'],
    ['letter'=>'८२', 'word'=>'बयासी',       'emoji'=>'बयासी - Eighty Two'],
    ['letter'=>'८३', 'word'=>'त्रियासी',    'emoji'=>'त्रियासी - Eighty Three'],
    ['letter'=>'८४', 'word'=>'चौरासी',      'emoji'=>'चौरासी - Eighty Four'],
    ['letter'=>'८५', 'word'=>'पचासी',       'emoji'=>'पचासी - Eighty Five'],
    ['letter'=>'८६', 'word'=>'छयासी',       'emoji'=>'छयासी - Eighty Six'],
    ['letter'=>'८७', 'word'=>'सतासी',       'emoji'=>'सतासी - Eighty Seven'],
    ['letter'=>'८८', 'word'=>'अठासी',       'emoji'=>'अठासी - Eighty Eight'],
    ['letter'=>'८९', 'word'=>'उनान्नब्बे',  'emoji'=>'उनान्नब्बे - Eighty Nine'],
    ['letter'=>'९०', 'word'=>'नब्बे',       'emoji'=>'नब्बे - Ninety'],
    ['letter'=>'९१', 'word'=>'एकान्नब्बे',  'emoji'=>'एकान्नब्बे - Ninety One'],
    ['letter'=>'९२', 'word'=>'बयान्नब्बे',  'emoji'=>'बयान्नब्बे - Ninety Two'],
    ['letter'=>'९३', 'word'=>'त्रियान्नब्बे','emoji'=>'त्रियान्नब्बे - Ninety Three'],
    ['letter'=>'९४', 'word'=>'चौरान्नब्बे', 'emoji'=>'चौरान्नब्बे - Ninety Four'],
    ['letter'=>'९५', 'word'=>'पन्चान्नब्बे','emoji'=>'पन्चान्नब्बे - Ninety Five'],
    ['letter'=>'९६', 'word'=>'छयान्नब्बे',  'emoji'=>'छयान्नब्बे - Ninety Six'],
    ['letter'=>'९७', 'word'=>'सन्तान्नब्बे','emoji'=>'सन्तान्नब्बे - Ninety Seven'],
    ['letter'=>'९८', 'word'=>'अन्ठान्नब्बे','emoji'=>'अन्ठान्नब्बे - Ninety Eight'],
    ['letter'=>'९९', 'word'=>'उनान्सय',     'emoji'=>'उनान्सय - Ninety Nine'],
    ['letter'=>'१००','word'=>'एक सय',       'emoji'=>'एक सय - One Hundred'],
],
'fruits' => [
    ['letter'=>'🍎', 'word'=>'Apple',      'emoji'=>'स्याउ'],
    ['letter'=>'🍌', 'word'=>'Banana',     'emoji'=>'केरा'],
    ['letter'=>'🍊', 'word'=>'Orange',     'emoji'=>'सुन्तला'],
    ['letter'=>'🍇', 'word'=>'Grapes',     'emoji'=>'अङ्गुर'],
    ['letter'=>'🍓', 'word'=>'Strawberry', 'emoji'=>'स्ट्रबेरी'],
    ['letter'=>'🍉', 'word'=>'Watermelon', 'emoji'=>'तरबुजा'],
    ['letter'=>'🍍', 'word'=>'Pineapple',  'emoji'=>'भूईकटहर'],
    ['letter'=>'🥭', 'word'=>'Mango',      'emoji'=>'आँप'],
    ['letter'=>'🍑', 'word'=>'Peach',      'emoji'=>'आरु'],
    ['letter'=>'🍒', 'word'=>'Cherry',     'emoji'=>'चेरी'],
    ['letter'=>'🍋', 'word'=>'Lemon',      'emoji'=>'कागती'],
    ['letter'=>'🍐', 'word'=>'Pear',       'emoji'=>'नाशपाती'],
    ['letter'=>'🫐', 'word'=>'Blueberry',  'emoji'=>'ब्लुबेरी'],
    ['letter'=>'🥝', 'word'=>'Kiwi',       'emoji'=>'किवी'],
    ['letter'=>'🍈', 'word'=>'Melon',      'emoji'=>'खरबुजा'],
    ['letter'=>'🥥', 'word'=>'Coconut',    'emoji'=>'नरिवल'],
    ['letter'=>'🍏', 'word'=>'Green Apple','emoji'=>'हरियो स्याउ'],
    ['letter'=>'🫒', 'word'=>'Olive',      'emoji'=>'जैतुन'],
    ['letter'=>'🍅', 'word'=>'Tomato',     'emoji'=>'गोलभेडा'],
    ['letter'=>'🌽', 'word'=>'Corn',       'emoji'=>'मकै'],
],

'vegetables' => [
    ['letter'=>'🥦', 'word'=>'Broccoli',   'emoji'=>'ब्रोकाउली'],
    ['letter'=>'🥕', 'word'=>'Carrot',     'emoji'=>'गाजर'],
    ['letter'=>'🥔', 'word'=>'Potato',     'emoji'=>'आलु'],
    ['letter'=>'🧅', 'word'=>'Onion',      'emoji'=>'प्याज'],
    ['letter'=>'🧄', 'word'=>'Garlic',     'emoji'=>'लसुन'],
    ['letter'=>'🌶️', 'word'=>'Chilli',     'emoji'=>'खुर्सानी'],
    ['letter'=>'🫑', 'word'=>'Capsicum',   'emoji'=>'भेडे खुर्सानी'],
    ['letter'=>'🥒', 'word'=>'Cucumber',   'emoji'=>'काँक्रो'],
    ['letter'=>'🍆', 'word'=>'Brinjal',    'emoji'=>'भन्टा'],
    ['letter'=>'🥬', 'word'=>'Spinach',    'emoji'=>'पालुंगो'],
    ['letter'=>'🫛', 'word'=>'Peas',       'emoji'=>'मटर'],
    ['letter'=>'🌿', 'word'=>'Coriander',  'emoji'=>'धनियाँ'],
    ['letter'=>'🍄', 'word'=>'Mushroom',   'emoji'=>'च्याउ'],
    ['letter'=>'🥜', 'word'=>'Peanut',     'emoji'=>'बदाम'],
    ['letter'=>'🫘', 'word'=>'Beans',      'emoji'=>'सिमी'],
    ['letter'=>'🥗', 'word'=>'Lettuce',    'emoji'=>'लेट्युस'],
    ['letter'=>'🌰', 'word'=>'Chestnut',   'emoji'=>'काष्ठफल'],
    ['letter'=>'🫚', 'word'=>'Ginger',     'emoji'=>'अदुवा'],
    ['letter'=>'🌱', 'word'=>'Radish',     'emoji'=>'मूला'],
    ['letter'=>'🎃', 'word'=>'Pumpkin',    'emoji'=>'फर्सी'],
],
];


$titles = [
  'abc'            => 'ABC & Letters',
  'nepali'         => 'नेपाली वर्णमाला',
  'numbers'        => 'Numbers & Counting',
  'fruits'     => 'Fruits 🍎',
  'vegetables' => 'Vegetables 🥦',
  'colors'         => 'Colors & Shapes',
  'animals'        => 'Animals & Sounds',
  'body'           => 'Body Parts 💪',
  'barakhadi'      => 'बाराखडी',
  'domestic'       => 'Domestic Animals 🐄',
  'wild'           => 'Wild Animals 🦁',
  'water'          => 'Water Animals 🐟',
  'nepali_numbers' => 'नेपाली संख्या 🔢',
];

$cards = $data[$subject];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Flashcards 📇</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <a href="<?php echo $subject; ?>.php">← Back</a>
  <h1>📇 <?php echo $titles[$subject]; ?></h1>

  <div class="flashcard-box">
    <div class="big-letter" id="fc-letter"></div>
    <div class="big-emoji"  id="fc-emoji"></div>
    <div class="fc-word"    id="fc-word"></div>
  

     <!-- ✅ ADD THIS speak button -->
    <button class="speak-btn" onclick="speakCard()" id="speak-btn">
      🔊 Listen
    </button>
  </div>

  <div class="fc-nav">
    <button onclick="fcPrev()">◀ Prev</button>
    <span id="fc-count"></span>
    <button onclick="fcNext()">Next ▶</button>
  </div>

  <!-- NO script.js here! All JS is inline below -->
  <script>
    
    const cards = <?php echo json_encode($cards); ?>;
      let fcIndex = 0;

      // =====================
      // SPEECH FUNCTION
      // =====================
      function speak(text, lang) {
        // Stop any current speech
        window.speechSynthesis.cancel();

        const utterance     = new SpeechSynthesisUtterance(text);
        utterance.lang      = lang || 'en-US';
        utterance.rate      = 0.8;   // slightly slow for kids
        utterance.pitch     = 1.2;   // slightly high pitch for kids
        utterance.volume    = 1;

        window.speechSynthesis.speak(utterance);
      }

      function speakCard() {
  const card = cards[fcIndex];
  const isNepali = /[\u0900-\u097F]/.test(card.word);

  if (isNepali) {
    speak(card.word, 'hi-IN');  // Hindi voice reads Devanagari script
  } else {
    const text = card.letter + ' — ' + card.word;
    speak(text, 'en-US');
  }
}

      function showCard(index) {
        document.getElementById('fc-letter').textContent = cards[index].letter;
        document.getElementById('fc-emoji').textContent  = cards[index].emoji;
        document.getElementById('fc-word').textContent   = cards[index].word;
        document.getElementById('fc-count').textContent  = (index + 1) + ' / ' + cards.length;

        // Auto speak when card changes
        speakCard();
      }

      function fcNext() {
        if (fcIndex < cards.length - 1) {
          fcIndex++;
          showCard(fcIndex);
        }
      }

      function fcPrev() {
        if (fcIndex > 0) {
          fcIndex--;
          showCard(fcIndex);
        }
      }

      showCard(0);
   
  </script>

</body>
</html>