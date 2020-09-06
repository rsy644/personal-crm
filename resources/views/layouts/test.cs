using Xunit;

namespace TreehouseDefense.Tests
{
	private Map _map3x3;
	private MapLocation[] _pathLocations3;
	
	public class PathTests
	{
		public PathTests()
		{
			_map3x3 = new Map(3, 3);

			_pathLocations = new MapLocation[]
			{
				new MapLocation(0, 1, _map3x3),
				new MapLocation(1, 1, _map3x3),
				new MapLocation(2, 1, _map3x3)
			};

			var target = new Path(pathLocations);
		}
		[Fact]
		public void MapLocationIsOnPath()
		{
			var map = new Map(3, 3);

			MapLocation[] pathLocations =
			{
				var map = new Map(3, 3);

				MapLocation[] pathLocations =
				{
					new MapLocation(0, 1, map),
					new MapLocation(1, 1, map),
					new MapLocation(2, 1, map)
				};

				var target = new Path(pathLocations);

				Assert.True(target.IsOnPath(new MapLocation(0, 1, map)));
			}
		}
		[Fact]
		public void MapLocationIsNotOnPath()
		{
			var map = new Map(3, 3);

			MapLocation[] pathLocations =
			{
				var map = new Map(3, 3);

				MapLocation[] pathLocations =
				{
					new MapLocation(0, 1, map),
					new MapLocation(1, 1, map),
					new MapLocation(2, 1, map)
				};

				var target = new Path(pathLocations);

				Assert.False(target.IsOnPath(new MapLocation(3, 3, map)));
			}
		}
	}
}