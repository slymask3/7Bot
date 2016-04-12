DROP FUNCTION IF EXISTS getCorrectLane;
DELIMITER //
CREATE FUNCTION getCorrectLane(lane VARCHAR(50), role VARCHAR(50)) RETURNS VARCHAR(50)
	BEGIN
    DECLARE correctlane VARCHAR(50);

    IF lane='"TOP"' THEN
        IF role='"SOLO"' THEN
            SET correctlane = 'Top';
        ELSEIF role='"DUO_CARRY"' THEN
            SET correctlane = 'Top';
        ELSEIF role='"DUO_SUPPORT"' THEN
            SET correctlane = 'Jungle';
		END IF;
    ELSEIF lane='"JUNGLE"' THEN
		SET correctlane = 'Jungle';
    ELSEIF lane='"MID"' OR lane='"MIDDLE"' THEN
        IF role='"SOLO"' THEN
            SET correctlane = 'Mid';
        ELSEIF role='"DUO_CARRY"' THEN
            SET correctlane = 'Mid';
        ELSEIF role='"DUO_SUPPORT"' THEN
            SET correctlane = 'Jungle';
		END IF;
    ELSEIF lane='"BOT"' OR lane='"BOTTOM"' THEN
        IF role='"DUO_CARRY"' THEN
            SET correctlane = 'ADC';
        ELSEIF role='"DUO_SUPPORT"' THEN
            SET correctlane = 'Support';
        ELSEIF role='"DUO"' THEN
            SET correctlane = 'Bot-Duo';
        ELSEIF role='"SOLO"' THEN
            SET correctlane = 'Bot-Solo';
		END IF;
	ELSE
		SET correctlane = 'None';
	END IF;

    RETURN correctlane;
    END //
DELIMITER ;