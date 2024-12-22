using AdventOfCode.Day1;

namespace AdventOfCodeTests
{
    [TestClass]
    public sealed class DayOneTester
    {
        [TestMethod]
        public void ExampleInputs()
        {
            // Arrange
            var testSubject = new Solution1();
            int expected = 31;
            List<int> list1 = new List<int>() { 3, 4, 2, 1, 3, 3 };
            Dictionary<int, int> list2 = new Dictionary<int, int>
            {
                { 4, 1 },
                { 3, 3 },
                { 5, 1 },
                { 9, 1 }
            };
            // Act
            int result = testSubject.TotalDistanceBetweenLists(list1, list2);

            // Assert
            Assert.AreEqual(expected, result);
        }
    }
}
