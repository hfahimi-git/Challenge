import java.util.*;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

public class WeightSort {
	
    public static class Pair implements Comparable<Pair> {
        private final String number;
        private final int weight;

        public String getNumber() {
            return number;
        }

        public int getWeight() {
            return weight;
        }

        public Pair(String number, int weight) {
            this.number = number;
            this.weight = weight;
        }

        @Override
        public int compareTo(Pair o) {
            if (this.weight > o.weight)
                return 1;
            else if (this.weight < o.weight)
                return -1;
            else
                return this.number.compareTo(o.number);
        }

        @Override
        public String toString() {
            return number;
        }
    }

    public static String orderWeight(String string) {
        if (string == null) {
            throw new RuntimeException("invalid input parameter");
        }
        string = string.trim();
        if (string.isEmpty()) {
            return string;
        }

        List<Pair> list = new ArrayList<>();
        String[] digits = string.split(" ");

        Pattern pattern = Pattern.compile("\\d+");
        for (String digit : digits) {
            if (pattern.matcher(digit).matches()) {
                list.add(new Pair(digit, getWeight(digit)));
            }
        }
        Collections.sort(list);
        return list.stream()
                .map(Pair::toString)
                .collect(Collectors.joining(" "));
    }

    public static int convert(String digit) {
        try {
            return Integer.parseInt(digit);
        } catch (NumberFormatException e) {
            return 0;
        }
    }

    public static int getWeight(String number) {
        char[] digits = number.toCharArray();
        int digitsLength = digits.length;
        int weight = 0;
        for (int i = 0; i < digitsLength; i++) {
            weight += convert(String.valueOf(digits[i]));
        }
        return weight;
    }
}
