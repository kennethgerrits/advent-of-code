using AdventOfCode.Helpers;
using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Linq;

namespace AdventOfCode.Day1
{
    public class Solution1
    {
        private readonly TxtReader _txtReader;
        private readonly string _filePath;

        public Solution1()
        {
            _txtReader = new TxtReader();
            string currentDirectory = Directory.GetCurrentDirectory();
            _filePath = Path.Combine(currentDirectory, "Day1\\input.txt");
        }

        public void Run()
        {
            List<int> list1 = new List<int>();
            Dictionary<int, int> list2 = new Dictionary<int, int>();

            foreach (string line in _txtReader.Read(_filePath))
            {
                string[] elements = line.Split(' ', StringSplitOptions.RemoveEmptyEntries);
                int leftNumber = int.Parse(elements[0]);
                int rightNumber = int.Parse(elements[1]);

                list1.Add(leftNumber);

                if (!list2.ContainsKey(rightNumber))
                {
                    list2.Add(rightNumber, 1);
                }
                else
                {
                    list2[rightNumber] = list2[rightNumber] + 1;
                }
            }

            var result = TotalDistanceBetweenLists(list1, list2);
            Console.WriteLine(result);
        }


        public int TotalDistanceBetweenLists(List<int> list1, Dictionary<int, int> list2)
        {
            int totalSimilarityScore = 0;
            for (int i = 0; i < list1.Count; i++)
            {
                list2.TryGetValue(list1[i], out int lookupValue);

                totalSimilarityScore += list1[i] * lookupValue;
            }

            return totalSimilarityScore;
        }
    }
}
