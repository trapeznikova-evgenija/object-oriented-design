#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"
#define _USE_MATH_DEFINES
#include <math.h>

using namespace std;

struct StationInfo
{
	std::string position;
};

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;
	double windSpeed = 0;
	double direction = 0;

	StationInfo stationInfo;
};

struct SWeatherInfoPro : public SWeatherInfo
{
	double windSpeed = 0;
	double direction = 0;
};

class CDisplay : public IObserver<SWeatherInfo>
{
private:

	void Update(SWeatherInfo const& data) override
	{
		std::cout << "State Position " << data.stationInfo.position << std::endl;

		std::cout << "Current Temp " << data.temperature << std::endl;
		std::cout << "Current Hum " << data.humidity << std::endl;
		std::cout << "Current Pressure " << data.pressure << std::endl;
		std::cout << "----------------" << std::endl;
	}
};

class CDisplayPro : public IObserver<SWeatherInfoPro>
{
	void Update(SWeatherInfoPro const& data) override
	{
		std::cout << "State Position " << data.stationInfo.position << std::endl;

		std::cout << "Current Wind Speed " << data.windSpeed << std::endl;
		std::cout << "Current Wind Direction " << data.direction << std::endl;
		std::cout << "Current Temp " << data.temperature << std::endl;
		std::cout << "Current Hum " << data.humidity << std::endl;
		std::cout << "Current Pressure " << data.pressure << std::endl;
		std::cout << "----------------" << std::endl;
	}
};

class CStatsData
{
public:
	void UpdateStatsData(const double sensorType)
	{
		if (m_minValue > sensorType)
		{
			m_minValue = sensorType;
		}
		if (m_maxValue < sensorType)
		{
			m_maxValue = sensorType;
		}
		m_accValue += sensorType;
		++m_countAcc;
		m_averageValue = m_accValue / m_countAcc;

		PrintStatsValue();
	}

private:
	void PrintStatsValue()
	{
		cout << "Max " << m_maxValue << endl;
		cout << "Min " << m_minValue << std::endl;
		cout << "Average " << m_averageValue << endl;
		cout << "----------------" << endl;
	}

	double m_minValue = numeric_limits<double>::infinity();
	double m_maxValue = -numeric_limits<double>::infinity();
	double m_accValue = 0;
	double m_averageValue = 0;
	unsigned m_countAcc = 0;
};

class CAverageWindDirection
{
public:
	double CalculateAverageWindDirection(const double degree, const double speed)
	{
		double x = cos(degree * M_PI / 180) * speed;
		double y = sin(degree * M_PI / 180) * speed;

		++m_countAcc;

		m_xCoord += x;
		m_yCoord += y;

		return atan2(m_yCoord / m_countAcc, m_xCoord / m_countAcc) * (180 / M_PI);
	}
private:
	double m_xCoord = 0;
	double m_yCoord = 0;
	unsigned m_countAcc = 0;
};

class CStatsDisplay : public IObserver<SWeatherInfo>
{
private:
	CStatsData temperature;
	CStatsData humidity;
	CStatsData pressure;

	void Update(SWeatherInfo const& data) override
	{
		PrintSensorTypeName("State Position");
		cout << data.stationInfo.position << endl;

		PrintSensorTypeName("Temperature");
		temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		pressure.UpdateStatsData(data.pressure);
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CStatsDisplayPro : public IObserver<SWeatherInfoPro>
{
private:
	CStatsData temperature;
	CStatsData humidity;
	CStatsData pressure;
	CStatsData windSpeed;
	CAverageWindDirection windDirection;

	void Update(SWeatherInfoPro const& data) override
	{
		PrintSensorTypeName("State Position");
		cout << data.stationInfo.position << endl;

		PrintSensorTypeName("Temperature");
		temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		pressure.UpdateStatsData(data.pressure);

		PrintSensorTypeName("Wind Speed");
		windSpeed.UpdateStatsData(data.windSpeed);

		PrintSensorTypeName("Wind Direction");
		double averageWindDirection = windDirection.CalculateAverageWindDirection(data.direction, data.windSpeed);
		cout << "Average " << averageWindDirection << endl;
		cout << "----------------" << endl;
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:

	CWeatherData(const StationInfo& stationInfo)
		: m_stationInfo(stationInfo)
	{

	}

	double GetTemperature()const
	{
		return m_temperature;
	}
	
	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	StationInfo GetStationInfo()const
	{
		return m_stationInfo;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;

		MeasurementsChanged();
	}
protected:
	SWeatherInfo GetChangedData() const override
	{
		SWeatherInfo info;
		info.stationInfo = GetStationInfo();
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	StationInfo m_stationInfo;
};

class CWeatherDataPro : public CObservable<SWeatherInfoPro>
{
public:

	CWeatherDataPro(const StationInfo& stationInfo)
		: m_stationInfo(stationInfo)
	{
		
	}

	double GetTemperature()const
	{
		return m_temperature;
	}

	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	StationInfo GetStationInfo()const
	{
		return m_stationInfo;
	}

	double GetWindSpeed()const
	{
		return m_wind_speed;
	}

	double GetWindDirection()const
	{
		return m_direction;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure, double windSpeed, double direction)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;
		m_direction = direction;
		m_wind_speed = windSpeed;

		MeasurementsChanged();
	}

protected:
	SWeatherInfoPro GetChangedData() const override
	{
		SWeatherInfoPro info;
		info.stationInfo = GetStationInfo();
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		info.windSpeed = GetWindSpeed();
		info.direction = GetWindDirection();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	double m_wind_speed = 0;
	double m_direction = 0;
	StationInfo m_stationInfo;
};

