namespace AdventOfCode.Helpers
{
    public class TxtReader
    {
        public TxtReader()
        {
        }

        public IEnumerable<string> Read(string filePath)
        {
            using (var reader = new StreamReader(filePath))
            {
                string line;
                while ((line = reader.ReadLine()) != null)
                {
                    yield return line;
                }
            }

        }
    }
}
