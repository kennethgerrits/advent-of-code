/*
* power rate = gamma * epsilon
* gamma = most common bit in the corresponding position of all numbers
* epsilon = least common bit in the corresponding position of all numbers
*/

List<string> lines;
readInput();
int bitCount = lines[0].Length;
List<string> gamma = new List<string>();
List<string> epsilon = new List<string>();

void readInput()
{
    lines = File.ReadLines("D:\\advent-of-code\\2021\\day-3-c-sharp\\day-3\\day-3\\input.txt").ToList();
}
// Horizontal loop (x-axis)
for (int i = 0; i < bitCount; i++)
{
    int zeroCount = 0;
    int oneCount = 0;
    
    // Vertical loop (y-axis)
    for (int j = 0; j < lines.Count; j++)
    {
        char[] bits = lines[j].ToCharArray();
        
        if (bits[i] == '0')
        {
            zeroCount++;
        }
        else
        {
            oneCount++;
        }
    }
    if (zeroCount > oneCount)
    {
        gamma.Add("0");
        epsilon.Add("1");
    }
    else
    {
        gamma.Add("1");
        epsilon.Add("0");
    }
}

string gammaBinary = String.Join("", gamma);
int gammaInt = Convert.ToInt32(gammaBinary, 2);
string epsilonBinary = String.Join("", epsilon);
int epsilonInt = Convert.ToInt32(epsilonBinary, 2);
int powerRate = gammaInt * epsilonInt;

// Console.WriteLine(powerRate);

/*
* Life support rating = oxygen * CO2
* oxygen = the most common value (0 or 1) in the current bit position. If 0 and 1 are equally common, keep values with a 1 in the position being considered.
* CO2 = the least common value in the current bit position. If 0 and 1 are equally common, keep values with a 0 in the position being considered.
*/

int oxygenInt = findOxygen();
int CO2Int = findCO2();
int LSR = oxygenInt * CO2Int;

int findOxygen()
{
    lines = File.ReadLines("D:\\advent-of-code\\2021\\day-3-c-sharp\\day-3\\day-3\\input.txt").ToList();
    for (int i = 0; i < bitCount; i++)
    {
        int zeroCount = 0;
        int oneCount = 0;

        // Vertical loop (y-axis)
        for (int j = 0; j < lines.Count; j++)
        {
            char[] bits = lines[j].ToCharArray();

            if (bits[i] == '0')
            {
                zeroCount++;
            }
            else
            {
                oneCount++;
            }
        }
        
        char mostCommonBit = oneCount >= zeroCount ? '1' : '0';
        
        lines = lines.Where(line => line[i] == mostCommonBit).ToList();

        if (lines.Count == 1)
        {
            return Convert.ToInt32(lines[0], 2);
        }

    }
    
    return -1;
}

int findCO2()
{
    lines = File.ReadLines("D:\\advent-of-code\\2021\\day-3-c-sharp\\day-3\\day-3\\input.txt").ToList();

    for (int i = 0; i < bitCount; i++)
    {
        int zeroCount = 0;
        int oneCount = 0;

        // Vertical loop (y-axis)
        for (int j = 0; j < lines.Count; j++)
        {
            char[] bits = lines[j].ToCharArray();

            if (bits[i] == '0')
            {
                zeroCount++;
            }
            else
            {
                oneCount++;
            }
        }
        
        char mostCommonBit = oneCount < zeroCount ? '1' : '0';
        
        lines = lines.Where(line => line[i] == mostCommonBit).ToList();

        if (lines.Count == 1)
        {
            return Convert.ToInt32(lines[0], 2);
        }

    }
    
    return -1;
}

Console.WriteLine($"oxygen: {oxygenInt}");
Console.WriteLine($"CO@: {CO2Int}");
Console.WriteLine($"Life: {LSR}");