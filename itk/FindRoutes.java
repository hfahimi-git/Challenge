import java.util.*;

public class FindRoutes {
    public static String findRoutes(ArrayList<ArrayList<String>> routes) {
        Map<String, String> trips = convertToMap(routes);
        String start = findStart(trips);
        return findPath(trips, start);
    }

    public static String findStart(Map<String, String> trips) {
        Map<String, String> copy = new HashMap<>(trips) ;
        copy.keySet().removeAll(trips.values());
        return copy.entrySet().iterator().next().getKey();
    }

    public static String findPath(Map<String, String> routes, String start) {
        StringJoiner result = new StringJoiner(", ");
        String next = routes.get(start);
        result
                .add(start)
                .add(next);
        routes.remove(start); //make the list a bit lighter

        for (Map.Entry<String, String> ignored : routes.entrySet()) {
            result.add(routes.get(next));
            next = routes.get(next);
        }

        return result.toString();
    }

    public static Map<String, String> convertToMap(ArrayList<ArrayList<String>> routes) {
        Map<String, String> trips = new HashMap<>();
        for (List<String> route : routes) {
            trips.put(route.get(0), route.get(1));
        }
        return trips;
    }

}
