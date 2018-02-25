
// Voltmeter properties:
// Array 8-16v ADCTICKSVOLT step
// Linear compesation for optocoupler H11F3 DIP-6 connected to A/D pin.
// Battery Side: R Diod = 5.6K to 12V
// AD-Side:      R FET Pull-up = 8.2K to 5V
static linearizeSensor voltSensor =
{
   {328,    332},
   {326,    330},
   {324,    328},
   {322,    326},
   {320,    324},
   {318,    322},
   {316,    320},
   {314,    317},
   {312,    315},
   {310,    313},
   {308,    312},
   {306,    310},
   {304,    309},
   {302,    307},
   {300,    305},
   {298,    304},
   {296,    303},
   {294,    302},
   {292,    301},
   {290,    300},
   {288,    298},
   {286,    296},
   {284,    294},
   {282,    292},
   {280,    289},
   {278,    288},
   {276,    286},
   {274,    284},
   {272,    283},
   {270,    281},
   {268,    279},
   {266,    278},
   {264,    276},
   {262,    275},
   {260,    273},
   {258,    271},
   {256,    270},
   {254,    268},
   {252,    266},
   {250,    265},
   {248,    263},
   {246,    262},
   {244,    260},
   {242,    258},
   {240,    257},
   {238,    255},
   {236,    253},
   {234,    252},
   {232,    250},
   {230,    249},
   {228,    247},
   {226,    245},
   {224,    244},
   {222,    242},
   {220,    241},
   {218,    239},
   {216,    237},
   {214,    236},
   {212,    234},
   {210,    232},
   {208,    231},
   {206,    229},
   {204,    228},
   {202,    226},
   {200,    224},
   {198,    223},
   {196,    221},
   {194,    219},
   {192,    218},
   {190,    216},
   {188,    215},
   {186,    213},
   {184,    211},
   {182,    210},
   {180,    208},
   {178,    206},
   {176,    205},
   {174,    203},
   {172,    202},
   {170,    200},
   {168,    198},
   {166,    197},
   {164,    195},
   {162,    194},
   {160,    192},
   {158,    190},
   {156,    189},
   {154,    187},
   {152,    185},
   {150,    184},
   {148,    182},
   {146,    181},
   {144,    179},
   {142,    177},
   {140,    176},
   {138,    174},
   {136,    172},
   {134,    171},
   {132,    169},
   {130,    168}
};

// Ampmeter properties:
// TBD
static linearizeSensor currSensor =
{
   {328,    332},
   {326,    330},
   {324,    328},
   {322,    326},
   {320,    324},
   {318,    322},
   {316,    320},
   {314,    317},
   {312,    315},
   {310,    313},
   {308,    312},
   {306,    310},
   {304,    309},
   {302,    307},
   {300,    305},
   {298,    304},
   {296,    303},
   {294,    302},
   {292,    301},
   {290,    300},
   {288,    298},
   {286,    296},
   {284,    294},
   {282,    292},
   {280,    289},
   {278,    288},
   {276,    286},
   {274,    284},
   {272,    283},
   {270,    281},
   {268,    279},
   {266,    278},
   {264,    276},
   {262,    275},
   {260,    273},
   {258,    271},
   {256,    270},
   {254,    268},
   {252,    266},
   {250,    265},
   {248,    263},
   {246,    262},
   {244,    260},
   {242,    258},
   {240,    257},
   {238,    255},
   {236,    253},
   {234,    252},
   {232,    250},
   {230,    249},
   {228,    247},
   {226,    245},
   {224,    244},
   {222,    242},
   {220,    241},
   {218,    239},
   {216,    237},
   {214,    236},
   {212,    234},
   {210,    232},
   {208,    231},
   {206,    229},
   {204,    228},
   {202,    226},
   {200,    224},
   {198,    223},
   {196,    221},
   {194,    219},
   {192,    218},
   {190,    216},
   {188,    215},
   {186,    213},
   {184,    211},
   {182,    210},
   {180,    208},
   {178,    206},
   {176,    205},
   {174,    203},
   {172,    202},
   {170,    200},
   {168,    198},
   {166,    197},
   {164,    195},
   {162,    194},
   {160,    192},
   {158,    190},
   {156,    189},
   {154,    187},
   {152,    185},
   {150,    184},
   {148,    182},
   {146,    181},
   {144,    179},
   {142,    177},
   {140,    176},
   {138,    174},
   {136,    172},
   {134,    171},
   {132,    169},
   {130,    168}
};

