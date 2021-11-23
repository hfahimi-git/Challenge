public class CalculateRotation {
    public static int shiftedDiff(String first, String second) {
        if (first == null || second == null) {
            throw new RuntimeException("invalid input parameter(s)");
        }

        if (first.equals(second)) {
            return 0;
        }

        int firstLength = first.length();
        StringBuilder stringBuilder = new StringBuilder(first);
        
        for (int i = 0; i < firstLength; i++) {
            stringBuilder = new StringBuilder()
                    .append(stringBuilder.charAt(firstLength - 1))
                    .append(stringBuilder, 0, firstLength - 1);

            if (second.equals(stringBuilder.toString())) {
                return i + 1;
            }
        }

        return -1;
    }
}
